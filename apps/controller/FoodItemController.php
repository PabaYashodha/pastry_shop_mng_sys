<?php
include_once  '../model/FoodItem.php';
$foodItemObj = new FoodItem();
$status = $_REQUEST['status'];

switch ($status) {
    case 'addFoodItem':
        try {
            $foodItemName = $_POST['foodItemName'];
            $unitPrice = $_POST['unitPrice'];
            $category = $_POST['category'];
            $subCategory = $_POST['subCategory'];

            if ($foodItemName == "") {
                throw new Exception("Food item name is required");
            }
            if ($unitPrice == "") {
                throw new Exception("Unit price is required");
            }
            if ($category == "") {
                throw new Exception("Category is required");
            }
            if ($subCategory == "") {
                throw new Exception("Sub category is required");
            }
            $result = $foodItemObj->existFoodItem($foodItemName);
            if ($result->num_rows != 0) {
                throw new Exception("Food Item name is already exist");
            }
            if ($_FILES["foodItemImage"]["name"] != "") {
                $foodItemImage = $_FILES["foodItemImage"]["name"];
                $foodItemImageExt = substr($foodItemImage, strrpos($foodItemImage, '.'));
                $foodItemImage = time() . $foodItemImageExt;
                $temp_loc = $_FILES["foodItemImage"]["tmp_name"];
                $new_loc = "../../images/foodItem-images/$foodItemImage";
                move_uploaded_file($temp_loc, $new_loc);
            } else {
                throw new Exception("image is required");
            }
            $result = $foodItemObj->addFoodItem($foodItemName, $unitPrice, $category, $subCategory, $foodItemImage);
            if ($result == 1) {
                $res = 1;
                $result = $foodItemObj->getFoodItemData();
                $foodItemArray = array();
                while ($row = $result->fetch_assoc()) {
                    array_push($foodItemArray, $row);
                }
                $msg = $foodItemArray;
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'getFoodItemData':
        $result = $foodItemObj->getFoodItemData();
        $foodItemArray = array();
        while ($row = $result->fetch_assoc()) {
            array_push($foodItemArray, $row);
        }
        echo json_encode($foodItemArray);
        break;

    case 'viewFoodItemDetails':
        $foodItemId = base64_decode($_POST['foodItemId']);
        $result = $foodItemObj->viewFoodItemDetails($foodItemId);
        $row = $result->fetch_assoc();
        echo json_encode($row);
        break;

    case 'changeFoodItemStatus':
        $foodItemId = base64_decode($_POST['foodItemId']);
        $foodItemStatus = $_POST['foodItemStatus'];
        $result = $foodItemObj->changeFoodItemStatus($foodItemId, $foodItemStatus);
        if ($result == 1) {
            $res = 1;
            $getFoodItemTbl = $foodItemObj->getFoodItemData();
            $foodItemArray  = array();
            while ($row = $getFoodItemTbl->fetch_assoc()) {
                array_push($foodItemArray, $row);
            }
            $msg = $foodItemArray;
        } else {
            $res = 2;
            $msg = "Oops food item can't deactivate";
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

   case 'editFoodItem':   
    try {
        $foodItemName = $_POST['editFoodItemName'];
        $unitPrice = $_POST['editUnitPrice'];
        $category = $_POST['editCategory'];
        $subCategory = $_POST['editSubCategory'];

        if ($foodItemName == "") {
            throw new Exception("Food item nae is required");
        }
        if ($unitPrice == "") {
            throw new Exception("Unit Price is required");
        }
        if ($category == "") {
            throw new Exception("Category is required"); 
        }
        if ($subCategory == "") {
            throw new Exception("Su category is required");
        }
        if ($_FILES["editFoodItemImage"]["name"]!= "") {
            $foodItemImage = $_FILES["editFoodItemImage"]["name"];
            $foodItemImageExt = substr($foodItemImage, strrpos($foodItemImage, '.'));
            $foodItemImage = time(). $foodItemImageExt;
            $temp_loc =$_FILES["editFoodItemImage"]["tmp_name"];
            $new_loc = "../../images/fodItem-images/$foodItemImage";
            move_uploaded_file($temp_loc, $new_loc);
        }else{
            throw new Exception("Image is required");
        }
        $result = $foodItemObj->addFoodItem($foodItemName, $unitPrice, $category, $subCategory, $foodItemImage);
        if ($result ==1 ) {
            $res = 1;
            $result = $foodItemObj->getFoodItemData();
            $foodItemArray = array();
            while($row = $result->fetch_assoc()){
                array_push($foodItemArray, $row);
            }
            $msg = $foodItemArray;
        }
    } catch (Throwable $th) {
        $res = 2;
        $msg = $th->getMessage();
    }  
    $data[0] = $res;
    $data[1] = $msg;
    echo json_encode($data);
    break;
}

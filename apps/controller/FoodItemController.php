<?php
include_once  '../model/FoodItem.php';
$foodItemObj = new FoodItem();
$status = $_REQUEST['status'];

switch ($status) {
    case 'checkFoodItemIsExist':
        $foodItemName = $_POST['foodItemName'];
        $result = $foodItemObj->checkFoodItemIsExist($foodItemName);
        echo ($result == false) ? 1 : '';
        break;

    case 'getFoodItemName':
        $searchKey = $_REQUEST['foodItemName'];
        $getFoodItemName = $foodItemObj->getFoodItemName($searchKey);
        $searchResult[] = "";
        while ($row = $getFoodItemName->fetch_assoc()) {
            $searchResult[] = array(
                "id" => $row['food_item_id'],
                "value" => $row['food_item_name'],
                "price"=>$row['food_item_unit_price']
            );
        }
        echo json_encode($searchResult);
        break;


    case 'addFoodItem':
        try {
            $foodItemName = $_POST['foodItemName'];
            $unitPrice = $_POST['unitPrice'];
            $foodItemCategoryId = $_POST['foodItemCategoryId'];
            $foodItemSubCategoryId = $_POST['foodItemSubCategoryId'];

            if ($foodItemName == "") {
                throw new Exception("Food item name is required");
            }
            if ($unitPrice == "") {
                throw new Exception("Unit price is required");
            }
            if ($foodItemCategoryId == "") {
                throw new Exception("Category is required");
            }
            if ($foodItemSubCategoryId == "") {
                throw new Exception("Sub category is required");
            }
            // $result = $foodItemObj->existFoodItem($foodItemName);
            // if ($result->num_rows != 0) {
            //     throw new Exception("Food Item name is already exist");
            // }
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
            $result = $foodItemObj->addFoodItem($foodItemName, $unitPrice, $foodItemCategoryId,  $foodItemSubCategoryId, $foodItemImage);
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
        
    case 'getFoodItemNameById':
        $foodItemId = base64_decode($_GET['foodItemId']);
        $getFoodItemName = $foodItemObj->getFoodItemNameById($foodItemId);
        $row = $getFoodItemName->fetch_assoc();
        echo json_encode($row);
        break;


    case 'editFoodItem':
        try {
            $foodItemId = base64_decode($_POST['editFoodItemId']);
            $foodItemName = $_POST['editFoodItemName'];
            $unitPrice = $_POST['editUnitPrice'];
            $foodItemCategory = $_POST['editFoodItemCategoryName'];
            $foodItemSubCategory = $_POST['editFoodItemSubCategory'];
            $foodItemImage = "";

            if ($foodItemName == "") {
                throw new Exception("Food item nae is required");
            }
            if ($unitPrice == "") {
                throw new Exception("Unit Price is required");
            }
            if ($foodItemCategory == "") {
                throw new Exception("Category is required");
            }
            if ($foodItemSubCategory == "") {
                throw new Exception("Sub category is required");
            }
            if ($_FILES["editFoodItemImage"]["name"] != "") {
                $foodItemImage = $_FILES["editFoodItemImage"]["name"];
                $foodItemImageExt = substr($foodItemImage, strrpos($foodItemImage, '.'));
                $foodItemImage = time() . $foodItemImageExt;
                $temp_loc = $_FILES["editFoodItemImage"]["tmp_name"];
                $new_loc = "../../images/foodItem-images/$foodItemImage";
                move_uploaded_file($temp_loc, $new_loc);
            }
            $result = $foodItemObj->editFoodItem($foodItemId, $foodItemName, $unitPrice, $foodItemCategory, $foodItemSubCategory, $foodItemImage);
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
}

<?php 
include_once '../model/FoodItem.php';
$foodItemObj = new FoodItem();
$status = $_REQUEST['status'];

switch ($status) {
    case 'addFoodItem':
        try {
            $foodItemName = $_POST['foodItemName'];
            $unitPrice = $_POST['unitPrice'];
            $category = $_POST['category'];
            $subCategory = $_POST['subCategory'];
           
            if ($foodItemName =="") {
               throw new Exception("Food item name is required");
            }
            if($unitPrice == ""){
                throw new Exception("Unit price is required");
            }
            if ($category == "") {
                throw new Exception("Category name is required");
            }
            if ($subCategory =="") {
                throw new Exception("Sub category name is required");
            }
            if ($_FILES["foodItemImage"]["name"] != "") {
                $foodItemImage = $_FILES["foodItemImage"]["name"];
                $foodItemImageExt = substr($foodItemImage, strrpos($foodItemImage,'.'));
                $foodItemImage = time().$foodItemImageExt;
                $temp_loc = $_FILES["foodItemImage"]["tmp_name"];
                $new_loc = "../../images/foodItem-images/$foodItemImage";
                move_uploaded_file($temp_loc, $new_loc);
            }else{
                throw new Exception("image is required");
            }
            $result = $foodItemObj->addFoodItem($foodItemName, $unitPrice, $category, $subCategory, $foodItemImage);
            if ($result == 1){
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
        $data[1] =$msg;
        echo json_encode($data);
        break;

    
   case 'getFoodItemData':
    $result = $foodItemObj->getFoodItemData();
    $foodItemArray = array();
    while ($row = $result->fetch_assoc()) {
       array_push($foodItemArray, $row);
    }
    echo json_encode($foodItemArray);

    
    case 'viewFoodDetails':
        $foodItemId = $_POST['foodItemId'];
        $result = $foodItemObj->viewFoodDetails($foodItemId);
        $row = $result->fetch_assoc($row);
        break;
}
?>
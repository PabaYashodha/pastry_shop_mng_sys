<?php
include_once '../../config/dbConnection.php';
new dbConnection;

class FoodItem
{
    public function addFoodItem( $foodItemName, $unitPrice, $category, $subCategory, $foodItemImage)
    {
        //    $today = date("Y-m-d");
        $conn = $GLOBALS['con'];
        $sql = "INSERT INTO `food_item` (`food_item_name`, `food_item_unit_price`, `food_item_image`, `food_item_category_food_item_category_id`, `sub_category_sub_category_id`)
                VALUES ('$foodItemName', '$unitPrice', '$foodItemImage', '$category', '$subCategory')";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getFoodItemData()
    {
        $conn = $GLOBALS['con'];
        $sql = "SELECT * FROM `food_item`";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function viewFoodDetails($foodItemId)
    {
        $conn = $GLOBALS['con'];
        $sql = "SELECT * FROM `foodItem` WHERE `foodItem_id` = '$foodItemId'";
        $result=$conn->query($sql) or die($conn->error);
        return $result;
    }
}

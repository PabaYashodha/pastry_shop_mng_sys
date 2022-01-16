<?php
include_once '../../config/dbConnection.php';
class FoodItem
{
    private $db;

    public function __construct()
    {
        $this->db= new dbConnection();
    }
    
    public function addFoodItem( $foodItemName, $unitPrice, $foodItemCategory, $foodItemSubCategory, $foodItemImage)
    {
        //    $today = date("Y-m-d");
        $conn= $this->db->connection();
        $sql = "INSERT INTO `food_item` (`food_item_name`, `food_item_unit_price`, `food_item_image`, `food_item_category_food_item_category_id`, `sub_category_sub_category_id`)
                VALUES ('$foodItemName', '$unitPrice', '$foodItemImage', '$foodItemCategory', '$foodItemSubCategory')";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getFoodItemData()
    {
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `food_item`";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
    public function viewFoodItemDetails($foodItemId)
    {
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `food_item` WHERE `food_item_id`= '$foodItemId' ";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function changeFoodItemStatus($foodItemId, $foodItemStatus)
    {
        $conn= $this->db->connection();
        $sql = "UPDATE `food_item` SET `food_item_status`= '$foodItemStatus' WHERE `food_item_id`='$foodItemId'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
    public function editFoodItem($foodItemId, $foodItemName, $unitPrice, $foodItemCategory, $foodItemSubCategory, $foodItemImage)
    {
        $conn = $this->db->connection();
        $sql = "UPDATE `food_item` SET `food_item_name` = '$foodItemName', `food_item_unit_price` = '$unitPrice', `food_item_category_food_item_category_id`= '$foodItemCategory', `sub_category_sub_category_id` = '$foodItemSubCategory' WHERE `food_item_id` = '$foodItemId' ";
        $result = $conn->query($sql) or die ($conn->error);
        return $result;
    }
    public function existFoodItem($foodItemName)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `food_item_name` FROM `food_item` WHERE `food_item_name` LIKE '%$foodItemName%'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
}
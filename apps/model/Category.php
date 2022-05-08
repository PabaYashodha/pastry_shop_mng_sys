<?php
include_once '../../config/dbConnection.php';

class category
{
    private $db;

    public function __construct()
    {
        $this->db = new dbConnection();
    }

    public function checkCategoryNameIsExist($categoryName)
    {
        $conn = $this->db->connection();
        // $sql = "SELECT `category_name` FROM `category` WHERE `category_name` LIKE '%$categoryName%'";
        $sql = "SELECT `category_name` FROM `category` WHERE `category_name`='$categoryName'";
        $checkCategoryNameIsExist = $conn->query($sql) or die($conn->error);
        return ($checkCategoryNameIsExist->num_rows > 0) ? false : true;
    }

    public function addCategory($categoryName, $categoryImage)
    {
        $conn = $this->db->connection();
        $sql = "INSERT INTO `category` (`category_name`,`category_image`) VALUES ('$categoryName','$categoryImage')";
        $addCategoryData = $conn->query($sql) or die($conn->error);
        return $addCategoryData;
    }

    public function getCategoryData()
    {
        $conn = $this->db->connection();
        $sql = "SELECT * FROM `category`";
        $getCategoryData = $conn->query($sql) or die($conn->error);
        return $getCategoryData;
    }

    public function viewCategoryDetails($categoryId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT * FROM `category` WHERE `category_id` = '$categoryId'";
        $viewCategory = $conn->query($sql) or die($conn->error);
        return $viewCategory;
    }

    public function editCategory($categoryId, $categoryName, $categoryImage)
    {
        $conn = $this->db->connection();
        if ($categoryImage == "") {
            $sql = "UPDATE `category` SET `category_name` = '$categoryName' WHERE `category_id` = '$categoryId'";
        } else {
            $sql = "UPDATE `category` SET `category_name` = '$categoryName', `category_image`='$categoryImage' WHERE `category_id` = '$categoryId'";
        }
        $editCategory = $conn->query($sql) or die($conn->error);
        return $editCategory;
    }

    public function changeCategoryStatus($categoryId, $categoryStatus)
    {
        $conn = $this->db->connection();
        $sql = "UPDATE `category` SET `category_status` = '$categoryStatus' WHERE `category_id` = '$categoryId'";
        $changeCategoryStatus = $conn->query($sql) or die($conn->error);
        return $changeCategoryStatus;
    }

    public function deleteCategory($categoryId)
    {
        $conn = $this->db->connection();
        $sql = "DELETE FROM `category` WHERE `category_id` = '$categoryId'";
        $deleteCategory = $conn->query($sql) or die($conn->error);
        return $deleteCategory;
    }
    public function getCategoryById($categoryId)
    {
        $conn= $this->db->connection();
        $sql = "SELECT `category_name` FROM `category` WHERE `category_id` ='$categoryId'";
        $getCategoryName = $conn->query($sql) or die($conn->error);
        return $getCategoryName;
    }
    public function existEditCategoryName($categoryName) // select no 1 if category_name=$categoryName
    {
        $conn = $this->db->connection();
        $sql = "SELECT 1 FROM `category` WHERE `category_name`='$categoryName'";
        $existEditCategoryName = $conn->query($sql) or die($conn->error);
        if ($existEditCategoryName->num_rows > 1) {
            return false;
        } else {
            return true;
        }
    }
    
    public function getCategoryName($searchKey)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `category_id`, `category_name` FROM `category` WHERE `category_name` LIKE '%$searchKey%'";
        $getCategoryName = $conn->query($sql) or die($conn->error);
        return $getCategoryName;
    }
}

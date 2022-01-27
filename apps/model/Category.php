<?php
include_once '../../config/dbConnection.php';

class category{
    private $db;

    public function __construct()
    {
        $this->db =new dbConnection();
    }

    public function existCategory($categoryName)
    {
        $conn =$this->db->connection();
        $sql = "SELECT `category_name` FROM `category` WHERE `category_name` LIKE '%$categoryName%'";
        $existCategory = $conn->query($sql) or die($conn->error);
        return $existCategory;
    }

    public function addCategory($categoryName)
    {
        $conn = $this->db->connection();
        $sql = "INSERT INTO `category` (`category_name`) VALUES ('$categoryName')";
        $addCategoryData = $conn->query($sql) or die($conn->error);
        return $addCategoryData;
    }

    public function getCategoryData()
    {
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `category`";
        $getCategoryData = $conn->query($sql) or die($conn->error);
        return $getCategoryData;
    }

    public function viewCategoryDetails($categoryId)
    {
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `category` WHERE `category_id` = '$categoryId'";
        $viewCategory = $conn->query($sql) or die($conn->error);
        return $viewCategory;
    }

    public function editCategory($categoryId, $categoryName)
    {
        $conn= $this->db->connection();
        $sql = "UPDATE `category` SET `category_name` = '$categoryName' WHERE `category_id` = '$categoryId'";
        $editCategory = $conn->query($sql) or die($conn->error);
        return $editCategory;
    }

    public function changeCategoryStatus($categoryId,$categoryStatus)
    {
        $conn= $this->db->connection();
        $sql = "UPDATE `category` SET `category_status` = '$categoryStatus' WHERE `category_id` = '$categoryId'";
        $changeCategoryStatus =$conn->query($sql) or die($conn->error);
        return $changeCategoryStatus;
    }

    public function deleteCategory($categoryId)
    {
        $conn= $this->db->connection();
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
    
}
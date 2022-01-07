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
}
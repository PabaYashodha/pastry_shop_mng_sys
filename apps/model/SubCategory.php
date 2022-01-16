<?php 
include_once '../../config/dbConnection.php';

class subCategory{
    private $db;

    public function __construct()
    {
        $this->db =new dbConnection();
    }

    public function existSubCategory($subCategoryName)
    {
        $conn= $this->db->connection();
        $sql = "SELECT `sub_category_name` FROM `sub_category` WHERE `sub_category_name` LIKE '%$subCategoryName%'";
        $existSubCategoryName = $conn->query($sql) or die($conn->error);
        return $existSubCategoryName;
    }

    public function addSubCategory($subCategoryName, $subCategoryCategoryItems)
    {
        $conn= $this->db->connection();
        $sql = "INSERT INTO `sub_category` (`sub_category_name`,`category_category_id`) VALUES ('$subCategoryName' ,'$subCategoryCategoryItems')";
        $addSubCategory =$conn->query($sql) or die($conn->error);
        return $addSubCategory;
    }

    public function getSubCategoryData()
    {
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `sub_category`";
        $getSubCategoryData = $conn->query($sql) or die($conn->error);
        return $getSubCategoryData;
    }
   
}
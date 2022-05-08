<?php
include_once '../../config/dbConnection.php';

class subCategory
{
    private $db;

    public function __construct()
    {
        $this->db = new dbConnection();
    }

    public function existSubCategory($subCategoryName)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `sub_category_name` FROM `sub_category` WHERE `sub_category_name` LIKE '%$subCategoryName%'";
        $existSubCategoryName = $conn->query($sql) or die($conn->error);
        return $existSubCategoryName;
    }

    public function addSubCategory($subCategoryName, $subCategoryCategoryItem,$subCategoryImage)
    {
        $conn = $this->db->connection();
        $sql = "INSERT INTO `sub_category` (`sub_category_name`,`sub_category_image`,`category_category_id`) VALUES ('$subCategoryName','$subCategoryImage' ,'$subCategoryCategoryItem')";
        $addSubCategory = $conn->query($sql) or die($conn->error);
        return $addSubCategory;
    }

    public function getSubCategoryData()
    {
        $conn = $this->db->connection();
        $sql = "SELECT * FROM `sub_category`";
        $getSubCategoryData = $conn->query($sql) or die($conn->error);
        return $getSubCategoryData;
    }

    public function viewSubCategoryData($subCategoryId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT * FROM `sub_category` WHERE `sub_category_id` = '$subCategoryId'";
        $viewSubCategory = $conn->query($sql) or die($conn->error);
        return $viewSubCategory;
    }

    public function editSubCategory($subCategoryId, $subCategoryName, $subCategoryCategoryItem,$subCategoryImage)
    {
        $conn = $this->db->connection();
        if ($subCategoryImage=="") {
            $sql = "UPDATE `sub_category` SET `sub_category_name`='$subCategoryName' , `category_category_id` ='$subCategoryCategoryItem' WHERE `sub_category_id`= '$subCategoryId'";
        }else{
            $sql = "UPDATE `sub_category` SET `sub_category_name`='$subCategoryName', `sub_category_image`='$subCategoryImage' , `category_category_id` ='$subCategoryCategoryItem' WHERE `sub_category_id`= '$subCategoryId'";
        }
        $editSubCategory = $conn->query($sql) or die($conn->error);
        return $editSubCategory;
    }
    public function changeSubCategoryStatus($subCategoryId, $subCategoryStatus)
    {
        $conn = $this->db->connection();
        $sql = "UPDATE `sub_category` SET `sub_category_status`='$subCategoryStatus' WHERE `sub_category_id`= '$subCategoryId'";
        $changeSubCategoryStatus = $conn->query($sql) or die($conn->error);
        return $changeSubCategoryStatus;
    }

    public function deleteSubCategory($subCategoryId)
    {
        $conn = $this->db->connection();
        $sql = "DELETE `sub_category` WHERE `sub_category_id` = '$subCategoryId'";
        $deleteSubCategory = $conn->query($sql) or die($conn->error);
        return $deleteSubCategory;
    }

    public function getSubCategoryById($subCategoryId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `sub_category_name` FROM `sub_category` WHERE `sub_category_id`= '$subCategoryId'";
        $getSubCategoryName = $conn->query($sql) or die($conn->error);
        return $getSubCategoryName;
    }
    public function existEditSubCategory($subCategoryName)
    {
        $conn = $this->db->connection();
        $sql = "SELECT 1 FROM `sub_category` WHERE `sub_category_name`='$subCategoryName'";
        $existEditSubCategoryName = $conn->query($sql) or die($conn->error);
        if ($existEditSubCategoryName->num_rows > 1) {
            return false;
        }else{
            return true;
        };
    }

    public function getSubCategoryName($searchKey)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `sub_category_id`, `sub_category_name` FROM `sub_category` WHERE `sub_category_name` LIKE '%$searchKey%'";
        $getSubCategoryName = $conn->query($sql) or die($conn->error);
        return $getSubCategoryName;
    }
}

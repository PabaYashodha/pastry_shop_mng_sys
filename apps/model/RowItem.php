<?php
include_once '../../config/dbConnection.php';

class RowItem
{
    private $db;

    public function __construct()
    {
        $this->db = new dbConnection();
    }

   
    public function existRowItemName($rowItemName)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `row_item_name` FROM `row_item` WHERE `row_item_name` LIKE '%$rowItemName%'";
        $existRowItemName = $conn->query($sql) or die($conn->error);
        return $existRowItemName;
    }

    public function addRowItem($rowItemName,$rowItemReorderLevel)
    {
        $conn = $this->db->connection();
        $sql = "INSERT INTO `row_item` (`row_item_name`,`row_item_reorder_level`) VALUES ('$rowItemName','$rowItemReorderLevel')";
        $addRowItem = $conn->query($sql) or die($conn->error);
        return $addRowItem;
    }

    public function getRowItemData()
    {
        $conn = $this->db->connection();
        $sql = "SELECT * FROM `row_item`";
        $getRowItemData = $conn->query($sql) or die($conn->error);
        return $getRowItemData;
    }

    public function changeRowItemStatus($rowItemId, $rowItemStatus)
    {
        $conn = $this->db->connection();
        $sql = "UPDATE `row_item` SET `row_item_status` = '$rowItemStatus' WHERE `row_item_id` ='$rowItemId'";
        $changeRowItemStatus = $conn->query($sql) or die($conn->error);
        return $changeRowItemStatus;
    }

    public function editRowItem($rowItemId, $rowItemName,$rowItemReorderLevel)
    {
        $conn = $this->db->connection();
        $sql = "UPDATE `row_item` SET `row_item_name` ='$rowItemName', `row_item_reorder_level`='$rowItemReorderLevel' WHERE `row_item_id` = '$rowItemId'";
        $editRowItem = $conn->query($sql) or die($conn->error);
        return $editRowItem;
    }

    public function viewRowItem($rowItemId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT * FROM `row_item` WHERE `row_item_id` = '$rowItemId'";
        $viewRowItem = $conn->query($sql) or die($conn->error);
        return $viewRowItem;
    }

    public function getRowItemByRowItemName($searchKey)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `row_item_id`, `row_item_name` FROM `row_item` WHERE `row_item_name` LIKE '%$searchKey%'";
        $getRowItemByRowItemName = $conn->query($sql) or die($conn->error);
        return $getRowItemByRowItemName;
    }

    public function getRowItemById($rowItemId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `row_item_name` FROM `row_item` WHERE `row_item_id`= '$rowItemId'";
        $getRowItemName = $conn->query($sql) or die($conn->error);
        return $getRowItemName;
    }

    public function getReorderList()
    {
        $conn = $this->db->connection();
        $sql = "SELECT `row_item_id`, `row_item_name`, `row_item_reorder_level` FROM `row_item`";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
}

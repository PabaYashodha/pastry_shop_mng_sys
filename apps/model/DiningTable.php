<?php
include_once '../../config/dbConnection.php';
new dbConnection;

class DiningTable
{
    public function addDiningTable($tableName, $tableCapacity)
    {
        $conn = $GLOBALS['con'];
        $sql = "INSERT INTO `dining_table`(`dining_table_name`,`dining_table_psn_cnt`)
                VALUES('$tableName', '$tableCapacity')";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getDiningTableData()
    {
        $conn = $GLOBALS['con'];
        $sql = "SELECT * FROM `dining_table`";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function viewDiningTableDetails($diningTableId)
    {
       $conn = $GLOBALS['con'];
       $sql = "SELECT * FROM `dining_table` WHERE `dining_table_id` ='$diningTableId'";
       $result = $conn->query($sql) or die ($conn->error);
       return $result;
    }

    public function editDiningTable($diningTableId, $tableName, $tableCapacity)
    {
        $conn = $GLOBALS['con'];
        $sql = "UPDATE `dining_table`SET `dining_table_name` = '$tableName', `dining_table_psn_cnt`= '$tableCapacity' WHERE `dining_table_id`= '$diningTableId'";
        $result = $conn->query($sql) or die ($conn->error);
        return $result;
    }

    public function changeDiningTableStatus($diningTableId, $diningTableStatus)
    {
        $conn = $GLOBALS['con'];
        $sql = "UPDATE `dining_table` SET `dining_table_status`= '$diningTableStatus' WHERE `dining_table_id`= '$diningTableId'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
}

<?php
include_once '../../config/dbConnection.php';
class DiningTable
{
    private $db;

    public function __construct()
    {
         $this->db = new dbConnection;
    }

    public function existDiningTable($tableName)
    {
        $conn = $this->db->connection();
        $sql = "SELECT * FROM `dining_table` WHERE `dining_table_name`= '$tableName'";
        $result = $conn->query($sql) or die($conn->error);
        $numRowsCount = $result->num_rows;
        if ($numRowsCount == 0) {
            return false; 
        }else{
            return true;
        }
    }
    
    public function addDiningTable($tableName, $tableCapacity)
    {
        $conn = $this->db->connection();
        $sql = "INSERT INTO `dining_table`(`dining_table_name`,`dining_table_psn_cnt`)
                VALUES('$tableName', '$tableCapacity')";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getDiningTableData()
    {
        $conn = $this->db->connection();
        $sql = "SELECT * FROM `dining_table`";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function viewDiningTableDetails($diningTableId)
    {
       $conn = $this->db->connection();
       $sql = "SELECT * FROM `dining_table` WHERE `dining_table_id` ='$diningTableId'";
       $result = $conn->query($sql) or die ($conn->error);
       return $result;
    }

    public function editDiningTable($diningTableId, $tableName, $tableCapacity)
    {
        $conn = $this->db->connection();
        $sql = "UPDATE `dining_table`SET `dining_table_name` = '$tableName', `dining_table_psn_cnt`= '$tableCapacity' WHERE `dining_table_id`= '$diningTableId'";
        $result = $conn->query($sql) or die ($conn->error);
        return $result;
    }

    public function changeDiningTableStatus($diningTableId, $diningTableStatus)
    {
        $conn = $this->db->connection();
        $sql = "UPDATE `dining_table` SET `dining_table_status`= '$diningTableStatus' WHERE `dining_table_id`= '$diningTableId'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
}

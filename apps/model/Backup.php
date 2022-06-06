<?php
include_once '../../config/dbConnection.php';
$dbConnObj= new dbConnection();

class BackUp{

    private $db;

    public function __construct()
    {
        $this->db = new dbConnection();
    }

    public function insertBackup($fileName,$name){
        $conn = $this->db->connection();
        $sql = "INSERT INTO backup(backup_name,backup_location) VALUES ('$name','$fileName')";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getBackup(){
        $conn = $this->db->connection();
        $sql = "SELECT * FROM backup ORDER BY backup_id DESC";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function setName(){
        $conn = $this->db->connection();
        $sql = "SET NAMES 'utf8'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function showTables(){
        $conn = $this->db->connection();
        $sql = "SHOW TABLES";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function selectTables($table){
        $conn = $this->db->connection();
        $sql = "SELECT * FROM $table";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function showCreatTable($table){
        $conn = $this->db->connection();
        $sql = "SHOW CREATE TABLE $table";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function removeBackup($backup_id){
        $conn = $this->db->connection();
        $sql = "DELETE FROM backup WHERE backup_name ='$backup_id'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    } 
    
    public function foreignKeyCheckOff(){
        $conn = $this->db->connection();
        $sql = "SET foreign_key_checks = 0";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function dropTables($table){
        $conn = $this->db->connection();
        $sql = "DROP TABLE IF EXISTS ".$table;
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

//    public function foreignKeyCheckOn(){
//        $conn = $this->db->connection();
//        $sql = "SET foreign_key_checks = 1";
//        $result = $conn->query($sql) or die($conn->error);
//        return $result;
//    }

    public function restoreSql($sql){
        $conn = $this->db->connection();
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getBackupData()
    {
        $conn = $this->db->connection();
        $sql = "SELECT * FROM `backup` ORDER BY `backup_id` DESC";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
    public function deleteBackup($backupId)
    {
        $conn = $this->db->connection();
        $sql = "DELETE FROM `backup` WHERE `backup_id` = '$backupId'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
}

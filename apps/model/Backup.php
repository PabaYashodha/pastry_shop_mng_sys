<?php
include_once '../../config/dbConnection.php';
$dbConnObj= new dbConnection();

class backUp{
    function insertBackup($fileName,$name){
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO backup(	backup_name,backup_location) VALUES ('$name','$fileName')";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    function getBackup(){
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM backup ORDER BY backup_id DESC";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    function setName(){
        $con = $GLOBALS['con'];
        $sql = "SET NAMES 'utf8'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    function showTables(){
        $con = $GLOBALS['con'];
        $sql = "SHOW TABLES";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    function selectTables($table){
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM $table";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    function showCreatTable($table){
        $con = $GLOBALS['con'];
        $sql = "SHOW CREATE TABLE $table";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    function removeBackup($backup_id){
        $con = $GLOBALS['con'];
        $sql = "DELETE FROM backup WHERE backup_name ='$backup_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    } 
    
    function foreignKeyCheckOff(){
        $con = $GLOBALS['con'];
        $sql = "SET foreign_key_checks = 0";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    function dropTables($table){
        $con = $GLOBALS['con'];
        $sql = "DROP TABLE IF EXISTS ".$table;
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

//    function foreignKeyCheckOn(){
//        $con = $GLOBALS['con'];
//        $sql = "SET foreign_key_checks = 1";
//        $result = $con->query($sql) or die($con->error);
//        return $result;
//    }

    function restoreSql($sql){
        $con = $GLOBALS['con'];
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

}

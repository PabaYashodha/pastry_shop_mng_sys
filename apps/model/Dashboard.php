<?php
include_once '../../config/dbConnection.php';
new dbConnection;

class Module{
    public function getModule()
    {
        $conn = $GLOBALS['con'];
        $sql = "SELECT * FROM `module`";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

}

<?php
include_once '../config/dbConnection.php';

class reportDb
{
    private $db;

    public function __construct()
    {
        $this->db= new dbConnection();
    }

    public function grnDailyReport()
    {
        date_default_timezone_set('Asia/Colombo');
        $today = date("Y-m-d");
        $conn= $this->db->connection();
        $sql = "SELECT `g`.`grn_ref_id`,  `g`.`grn_date`,  `g`.`grn_price`, `s`.`supplier_name` FROM `grn` `g` , `supplier` `s` 
        WHERE `g`.`supplier_supplier_id`= `s`.`supplier_id` AND DATE(`g`.`grn_created_at`) = '$today'  ORDER BY `g`.`grn_id` DESC ";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function grnLastWeekReport()
    {
        date_default_timezone_set('Asia/Colombo');
        $today = date("Y-m-d");
        $conn= $this->db->connection();
        $sql = "SELECT `g`.`grn_ref_id`,  `g`.`grn_date`,  `g`.`grn_price`, `s`.`supplier_name` FROM `grn` `g` , `supplier` `s` 
        WHERE `g`.`supplier_supplier_id`= `s`.`supplier_id` AND DATE(`g`.`grn_created_at`) BETWEEN ADDDATE('$today', INTERVAL -8 DAY) AND ADDDATE('$today', INTERVAL -1 DAY) ORDER BY `g`.`grn_id` DESC ";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function grnLastMonthReport()
    {
        date_default_timezone_set('Asia/Colombo');
        $today = date("Y-m-d");
        $conn= $this->db->connection();
        $sql = "SELECT `g`.`grn_ref_id`,  `g`.`grn_date`,  `g`.`grn_price`, `s`.`supplier_name` FROM `grn` `g` , `supplier` `s` 
        WHERE `g`.`supplier_supplier_id`= `s`.`supplier_id` AND DATE(`g`.`grn_created_at`) BETWEEN ADDDATE('$today', INTERVAL -8 DAY) AND ADDDATE('$today', INTERVAL -1 DAY) ORDER BY `g`.`grn_id` DESC ";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
}
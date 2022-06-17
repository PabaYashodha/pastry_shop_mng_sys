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
        WHERE `g`.`supplier_supplier_id`= `s`.`supplier_id` AND DATE(`g`.`grn_created_at`) BETWEEN DATE_ADD(LAST_DAY(DATE_SUB('$today', INTERVAL 2 MONTH)), INTERVAL 1 DAY) AND  LAST_DAY(DATE_SUB('$today', INTERVAL 1 MONTH)) ";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
   
    public function grnCustomDateReport()
    {
       
    }

    public function getUserDetails()
    {
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `user`";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getSupplierDetails()
    {
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `supplier`";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function invoiceDailyReport()
    {
        date_default_timezone_set('Asia/Colombo');
        $today = date("Y-m-d");
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `invoice` WHERE DATE(`invoice_date`)='$today' ORDER BY `invoice_id` DESC";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function invoiceLastWeekReport()
    {
        date_default_timezone_set('Asia/Colombo');
        $today = date("Y-m-d");
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `invoice` WHERE DATE(`invoice_date`) BETWEEN ADDDATE('$today', INTERVAL -8 DAY) AND ADDDATE('$today', INTERVAL -1 DAY) ORDER BY `invoice_id` DESC";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function invoiceLastMonthReport()
    {
        date_default_timezone_set('Asia/Colombo');
        $today = date("Y-m-d");
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `invoice` WHERE DATE(`invoice_date`) BETWEEN ADDDATE('$today', INTERVAL -8 DAY) AND ADDDATE('$today', INTERVAL -1 DAY) ORDER BY `invoice_id` DESC";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function invoiceCustomDateReport($salesFromDate, $salesToDate)
    {
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `invoice` WHERE DATE(`invoice_date`) BETWEEN $salesFromDate AND $salesToDate ORDER BY `invoice_id` DESC";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function invoiceManualOrderReport()
    {
        date_default_timezone_set('Asia/Colombo');
       // $today = date("Y-m-d");
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `invoice` WHERE `invoice_type`='manual' ORDER BY `invoice_id` DESC";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function invoiceOnlineOrderReport()
    {
        date_default_timezone_set('Asia/Colombo');
       // $today = date("Y-m-d");
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `invoice` WHERE `invoice_type`='online' ORDER BY `invoice_id` DESC";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function availableStock()
    {
        $conn= $this->db->connection();
        $sql = "SELECT `row_item_name` FROM `row_item` WHERE `row_item_stock_sum`> 0";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
    public function outOfStockStock()
    {
        $conn= $this->db->connection();
        $sql = "SELECT `row_item_name` FROM `row_item` WHERE `row_item_stock_sum`= 0";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
    public function readToDelivery()
    {
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `ordertb` WHERE `ordertb_status`=3";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
    public function delivered()
    {
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `ordertb` WHERE `ordertb_status`=5";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
    public function deliveryDailyReport()
    {
        date_default_timezone_set('Asia/Colombo');
        $today = date("Y-m-d");
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `delivery` WHERE DATE(`delivery_date`)='$today' AND `delivery_status`=5 ORDER BY `delivery_id` DESC";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    
}
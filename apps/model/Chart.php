<?php
include_once '../../config/dbConnection.php';

class Chart{
    private $db;

    public function __construct()
    {
        $this->db = new dbConnection();
    }
    public function getPieChartValue()
    {
        $conn= $this->db->connection();
        date_default_timezone_set('asia/colombo');
        $today = date('Y-m-d');
        $sql= "SELECT DAYNAME(`invoice_date`) AS dayName,  SUM(`invoice_net_total`) AS `total` FROM `invoice` WHERE `invoice_date` 
        BETWEEN ADDDATE('$today', INTERVAL -8 DAY) AND ADDDATE('$today', INTERVAL -1 DAY) GROUP BY DAYNAME(`invoice_date`)";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getColumChartValue()
    {
        $conn= $this->db->connection();
        date_default_timezone_set('asia/colombo');
        $today = date('Y-m-d');
        $sql= "SELECT MONTHNAME(`invoice_date`) AS monthName, SUM(`invoice_net_total`) AS `total` FROM `invoice` GROUP BY MONTH(`invoice_date`)";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }


}
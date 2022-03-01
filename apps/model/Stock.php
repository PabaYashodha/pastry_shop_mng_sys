<?php
include_once '../../config/dbConnection.php';

class Stock
{
    private $db;

    public function __construct()
    {
        $this->db = new dbConnection();
    }

    public function addStock($stockRowItemName,$stockReferenceNo,$stockAddingCount,$stockCurrentCount,$stockCostPerUnit,$stockMnfData,$stockExpDate)
    {
        $today = date("Y-m-d");
        $conn = $this->db->connection();
        $sql = "INSERT INTO `stock`(`stock_count`,`stock_current_count`,`stock_cost_per_unit`,`stock_create_date`,`stock_mnf_date`,`stock_exp_date`,`row_item_row_item_id`,`grn_grn_id`)
                VALUES ('$stockAddingCount', '$stockCurrentCount', '$stockCostPerUnit', '$today','$stockMnfData','$stockExpDate','$stockRowItemName','$stockReferenceNo')";
        $addStock =$conn->query($sql) or die($conn->error);
        return $addStock;
    }
    
    // public function existReferenceId($stockReferenceId)
    // {
    //     $conn = $this->db->connection();
    //     $sql = "SELECT `grn_grn_id` FROM `stock` WHERE `grn_grn_id` LIKE '%$stockReferenceId%' ";
    //     $$existReferenceId = $conn->query($sql) or die($conn->error);
    //     return $existReferenceId;
    // }

    public function getStockData()
    {
        $conn = $this->db->connection();
        $sql =  "SELECT * FROM `stock`";
        $getStockData = $conn->query($sql) or die($conn->error);
        return $getStockData;
    }
 }

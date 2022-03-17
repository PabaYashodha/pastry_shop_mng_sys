<?php
include_once '../../config/dbConnection.php';

class Stock
{
    private $db;

    public function __construct()
    {
        $this->db = new dbConnection();
    }

    public function addStock($stockReceivedQuantity,$stockCostPerUnit,$stockDiscount,$stockMnfData,$stockExpDate,$stockTableNetCost,$value, $addGrn)
    {
        $conn = $this->db->connection();
        $sql = "INSERT INTO `stock`(`stock_count`,`stock_current_count`,`stock_cost_per_unit`,`stock_discount`,stock_mnf_date`,`stock_exp_date`,`stock_net_cost`,`row_item_row_item_id`,`grn_grn_id`)
                VALUES ('$stockReceivedQuantity', '$stockReceivedQuantity', '$stockCostPerUnit','$stockDiscount','$stockMnfData','$stockExpDate','$stockTableNetCost','$value', '$addGrn')";
        $addStock =$conn->query($sql) or die($conn->error);
        return $addStock;
    }
    
    public function addGrn($stockSupplierName,$stockReferenceNo,$stockCreateDate,$stockNetTotal, $stockTotalDiscount)
    {
        $conn = $this->db->connection();
        $sql ="INSERT INTO `grn`(`grn_ref_id`,`grn_date`,`grn_price`,`grn_total_discount`,`supplier_supplier_id`) VALUES ('$stockReferenceNo','$stockCreateDate','$stockNetTotal','$stockTotalDiscount''$stockSupplierName')";
        $conn->query($sql) or die($conn->error);
        return $conn->insert_id;
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

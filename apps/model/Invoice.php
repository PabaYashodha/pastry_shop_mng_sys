<?php
include_once '../../config/dbConnection.php';

class Invoice
{
    private $db;
    public function __construct()
    {
        $this->db = new dbConnection();
    }

    public function getOnlineInvoiceData()
    {
        $conn = $this->db->connection();
        $sql =  "SELECT * FROM `invoice` WHERE `invoice_type`= 'online' ORDER BY `invoice_id` DESC";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
    public function getManualInvoiceData()
    {
        $conn = $this->db->connection();
        $sql =  "SELECT * FROM `invoice` WHERE `invoice_type`= 'manual' ORDER BY `invoice_id` DESC";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function viewOnlineOrderDetails($invoiceId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `i`.`invoice_id`,  `i`.`invoice_date` , `i`.`invoice_net_total`, `o`.* FROM  `invoice` `i`,  `ordertb` `o`
         WHERE `i`.`invoice_id` = `o`.`invoice_invoice_id` AND `i`.`invoice_id`='$invoiceId' AND `i`.`invoice_type`='online'";
        $result= $conn->query($sql) or die($conn->error);
        return $result; 
    }

    public function viewFoodOrderDetails($orderId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `f`.*, `o`.`ordertb_id` FROM `food_item_has_ordertb` `f`, `ordertb` `o` WHERE `f`.`ordertb_ordertb_id`= `o`.`ordertb_id` AND `o`.`ordertb_id`='$orderId'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function viewManualOrderDetails($invoiceId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `i`.*, `s`.`invoice_invoice_id` FROM `invoice` `i` , `sales` `s` WHERE `i`.`invoice_id` = `s`.`invoice_invoice_id` AND `i`.`invoice_id`='$invoiceId' AND `i`.`invoice_type`='manual' ORDER BY `invoice_id` DESC";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function viewFoodSalesDetails($invoiceId)
    {
        $conn = $this->db->connection();
        $sql ="SELECT `sales_quantity`, `sales_food_item_unit_price`, `food_item_food_item_id` FROM `sales` WHERE `invoice_invoice_id`='$invoiceId'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
    public function getInvoiceNumber()
    {
        $conn = $this->db->connection();
        $sql = "SELECT COUNT(`grn_id`) as `count` FROM `invoice`";
        $getInvoiceCount = $conn->query($sql);
        return $getInvoiceCount;
    }
}
<?php
include_once '../../config/dbConnection.php';

class Order
{
    private $db;
    public function __construct()
    {
        $this->db = new dbConnection();
    }

    //add manual orders
    public function addInvoice($invoiceSubAmount,$invoiceTotalDiscount,$invoiceNetTotal,$invoiceReceivedAmount,$invoiceBalanceAmount)
    {
        $today = date("Y-m-d");
        $invoiceType= 'manual';
        $conn= $this->db->connection();
        $sql = "INSERT INTO `invoice`(`invoice_date`,`invoice_sub_amount`,`invoice_discount`,`invoice_net_total`, `invoice_type`, `invoice_recieve_amount`,`invoice_balance_amount`)
        VALUES ('$today','$invoiceSubAmount','$invoiceTotalDiscount','$invoiceNetTotal', '$invoiceType', '$invoiceReceivedAmount','$invoiceBalanceAmount')";
         $conn->query($sql) or die($conn->error);
        return $conn->insert_id;
    }
    
    public function addSalesDetails($invoiceFoodItemQuantity,$invoiceFoodItemUnitPrice,$value,$addOrderDetails)
    {
        $conn= $this->db->connection();
        $sql= "INSERT INTO `sales`(`sales_quantity`,`sales_food_item_unit_price`,`invoice_invoice_id`,`food_item_food_item_id`)
        VALUES('$invoiceFoodItemQuantity','$invoiceFoodItemUnitPrice','$addOrderDetails','$value')";
         $addSales = $conn->query($sql) or die($conn->error);
         return $addSales;
    }

    public function getInvoiceData()
    {
        $conn = $this->db->connection();
        $sql =  "SELECT * FROM `invoice`";
        $getInvoiceData = $conn->query($sql) or die($conn->error);
        return $getInvoiceData;
    }

    public function getNewOnlineOrderData()
    {
        $conn= $this->db->connection();
        $sql = "SELECT `i`.`invoice_id`, `i`.`invoice_net_total`, `i`.`invoice_date`, `o`.`ordertb_status` FROM `invoice` `i`, `ordertb` `o`
         WHERE `i`.`invoice_id`= `o`.`invoice_invoice_id` AND `o`.`ordertb_status`='1'";
        $getNewOnlineOrderData = $conn->query($sql) or die($conn->error);
        return $getNewOnlineOrderData;
    }
    
    public function viewManualOrderDetails($invoiceId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT * FROM `invoice` `i` , `sales` `s` WHERE `i`.`invoice_id` = `s`.`invoice_invoice_id` AND `i`.`invoice_id`=$invoiceId";
        $result= $conn->query($sql) or die($conn->error);
        return $result;
    }
    public function changeManualOrderStatus($invoiceId, $manualOrderStatus)
    {
        $conn= $this->db->connection();
        $sql = "UPDATE `sales` SET `sales_status`='$manualOrderStatus' WHERE `invoice_invoice_id`='$invoiceId'";
        $result= $conn->query($sql) or die($conn->error);
        return $result;
    }
    public function getOnlineOrderData()
    {
        $conn = $this->db->connection();
        $sql = "SELECT `i`.`invoice_id`, `i`.`invoice_net_total`, `i`.`invoice_date`, `o`.`ordertb_status` FROM `invoice` `i`, `ordertb` `o` 
            WHERE `i`.`invoice_id` = `o`.`invoice_invoice_id` AND `i`.`invoice_type`='online' AND `ordertb_status`!='3' AND `ordertb_status`!='4'";
        $getOnlineOrderData = $conn->query($sql) or die($conn->error);
        return $getOnlineOrderData;
    }

    public function changeOnlineOrderStatus($invoiceId,$onlineOrderStatus)
    {
        $conn = $this->db->connection();
        $sql = "UPDATE `ordertb` SET `ordertb_status`='$onlineOrderStatus' WHERE `invoice_invoice_id`='$invoiceId'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
    
    public function viewOnlineOrderDetails($invoiceId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT * FROM `invoice` `i` , `ordertb` `o` WHERE `i`.`invoice_id` = `o`.`invoice_invoice_id` AND `i`.`invoice_id`='$invoiceId' AND `i`.`invoice_type`='online'";
        $result= $conn->query($sql) or die($conn->error);
        return $result;
    }
    public function viewFoodItemDetails($orderId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT * FROM `food_item_has_ordertb` `f`, `ordertb` `o` WHERE `f`.`ordertb_ordertb_id`= `o`.`ordertb_id` AND `o`.`ordertb_id`='$orderId'";
        $viewOrderFoodItemDetails = $conn->query($sql) or die($conn->error);
        return $viewOrderFoodItemDetails;
    }
}

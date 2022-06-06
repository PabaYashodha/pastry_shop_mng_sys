<?php
include_once '../../config/dbConnection.php';
class Module
{

    private $db;

    public function __construct()
    {
        $this->db = new dbConnection; //create object of dbConnection class
    }

    public function getModule($userId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `m`.* FROM `module` `m`, `role_has_module` `rm`, `role` `r` LEFT JOIN `user` `u` ON `r`.`role_id` = `u`.`role_role_id` WHERE `u`.`user_id` = '$userId' AND `r`.`role_id` = `rm`.`role_role_id` AND `rm`.`module_module_id` = `m`.`module_id`";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getReorderCount()
    {
        $conn = $this->db->connection();
        $sql = "SELECT COUNT(`row_item_id`) AS count FROM `row_item` WHERE (`row_item_reorder_level`) > (`row_item_stock_sum`)";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getNewOrderCount()
    {
        $conn = $this->db->connection();
        $sql = "SELECT COUNT(`ordertb_id`) AS count FROM `ordertb` WHERE `ordertb_status`=1";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getPendingDeliveryCount()
    {
        $conn = $this->db->connection();
        $sql = "SELECT COUNT(`ordertb_id`) AS count FROM `ordertb` WHERE `ordertb_status`=3";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getTodayRevenue()
    {
        date_default_timezone_set('Asia/Colombo');
        $today = date("Y-m-d");
        $conn = $this->db->connection();
        $sql = "SELECT IFNULL(SUM(`invoice_net_total`), 0) AS sum FROM `invoice` WHERE `invoice_date`='$today'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
   
}

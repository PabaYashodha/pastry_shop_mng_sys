<?php
include_once '../../config/dbConnection.php';

class Delivery
{
    private $db;
    public function __construct()
    {
        $this->db = new dbConnection();
    }

    public function getReadyToDeliveryData()
    {
        $conn= $this->db->connection();
        $sql = "SELECT `i`.`invoice_id`, `i`.`invoice_net_total`, `i`.`invoice_date`, `o`.`ordertb_id`, `o`.`ordertb_status` FROM `invoice` `i`, `ordertb` `o` 
        WHERE `i`.`invoice_id` = `o`.`invoice_invoice_id` AND `ordertb_status`!='1' AND `ordertb_status`!='2' AND `ordertb_status`!='4' AND `ordertb_status`!='5'";
        $getReadyToDeliveryData = $conn->query($sql) or die($conn->error);
        return $getReadyToDeliveryData;
    }

    public function getAssignDeliveryData()
    {
        $conn= $this->db->connection();
        $sql = "SELECT `i`.`invoice_id`, `i`.`invoice_date`, `o`.`ordertb_id`, `o`.`ordertb_status`,`u`.`user_fname`, `u`.`user_lname` 
        FROM `invoice` `i`, `ordertb` `o` , `delivery` `d` ,`user` `u`
        WHERE `i`.`invoice_id` = `o`.`invoice_invoice_id` AND `o`.`ordertb_id`= `d`.`ordertb_ordertb_id` AND `d`.`delivery_person_id`=`u`.`user_id` AND `o`.`ordertb_status`='4' ";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
    public function getOrderCompletedData()
    {
        $conn= $this->db->connection();
        $sql = "SELECT `i`.`invoice_id`, `i`.`invoice_net_total`, `i`.`invoice_date`, `o`.`ordertb_status`, `o`.`ordertb_id` FROM `invoice` `i`, `ordertb` `o` 
        WHERE `i`.`invoice_id` = `o`.`invoice_invoice_id` AND `ordertb_status`!='1' AND `ordertb_status`!='2' AND `ordertb_status`!='3' AND `ordertb_status`!='4' ";
        $getOrderCompletedData = $conn->query($sql) or die($conn->error);
        return $getOrderCompletedData;
    }

    public function getDeliveryPersonData()
    {
        $conn = $this->db->connection();
        $sql = "SELECT `user_id`, `user_fname`, `user_lname`, `user_contact`, `user_status` FROM `user` WHERE `role_role_id`='5'";
        $deliverPersonData=$conn->query($sql) or die($conn->error);
        return $deliverPersonData;
    }

    public function getActiveDeliveryPersonData()
    {
        $conn = $this->db->connection();
        $sql = "SELECT `user_id`, `user_fname`, `user_lname`, `user_contact` FROM `user` WHERE `role_role_id`='5' AND `user_status`='1'";
        $activeDeliveryPersonData=$conn->query($sql) or die($conn->error);
        return $activeDeliveryPersonData;
    }

    public function addDelivery($deliveryPerson,$orderId)
    {
        $conn = $this->db->connection();
        $sql = "INSERT INTO `delivery`(`delivery_person_id`, `ordertb_ordertb_id`, `delivery_status`) VALUES('$deliveryPerson', '$orderId', '4')";
        $addDelivery= $conn->query($sql) or die($conn->error);
        return $addDelivery;
    }

    public function updateOrderStatus($orderId)
    {
        $conn = $this->db->connection();
        $sql = "UPDATE `ordertb` SET `ordertb_status`= 4 WHERE `ordertb_id`='$orderId'";
        $result= $conn->query($sql) or die($conn->error);
        return $result;
    }
    public function getDeliveryData()
    {
        $conn= $this->db->connection();
        $sql = "SELECT * FROM `delivery`";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function viewDeliveryDetails($userId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT * FROM `user` WHERE `user_id`='$userId'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
}

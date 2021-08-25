<?php
include_once '../../config/dbConnection.php';
new dbConnection;

class Customer
{
    public function addCustomer($customerFirstName, $customerLastName, $customerContact, $customerEmail, $customerAdd1, $customerAdd2, $customerAdd3, $customerPostalCode, $customerNic, $customerBirthday, $customerGender)
    {
        $today = date("Y-m-d");
        $conn = $GLOBALS['con'];
        $sql ="INSERT INTO `customer`(`customer_fname`, `customer_lname`, `customer_contact`, `customer_email`, `customer_add1`, `customer_add2`, `customer_add3`, `customer_postal_code`, `customer_nic`, `customer_dob`, `customer_gender`, `customer_create_date`)
               VALUES('$customerFirstName', '$customerLastName', '$customerContact',' $customerEmail', '$customerAdd1', '$customerAdd2', '$customerAdd3', '$customerPostalCode', '$customerNic', '$customerBirthday', '$customerGender', '$today')";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getCustomerData()
    {
        $conn = $GLOBALS['con'];
        $sql = "SELECT * FROM `customer`";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function viewCustomerDetails($customerId)
    {
        $conn = $GLOBALS['con'];
        $sql = "SELECT * FROM `customer` WHERE `customer_id` = '$customerId'";
        $result=$conn->query($sql) or die($conn->error);
        return $result;
    }

    public function editCustomer($customerId, $customerFirstName, $customerLastName, $customerContact, $customerEmail, $customerAdd1, $customerAdd2, $customerAdd3, $customerPostalCode, $customerNic, $customerBirthday, $customerGender)
    {
        $conn = $GLOBALS['con'];
        $sql = "UPDATE `customer` SET `customer_fname`=' $customerFirstName', `customer_lname`='$customerLastName', `customer_contact`='$customerContact', `customer_email`= '$customerEmail', `customer_add1`='$customerAdd1', `customer_add2`='$customerAdd2', `customer_add3`='$customerAdd3', `customer_postal_code`='$customerPostalCode', `customer_nic`= '$customerNic', `customer_dob`='$customerBirthday', `customer_gender`='$customerGender' WHERE `customer_id`= '$customerId'";
        $result=$conn->query($sql) or die($conn->error);
        return $result;
    }
}
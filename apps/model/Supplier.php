<?php
include_once '../../config/dbConnection.php';

class Supplier
{
    private $db;

    public function __construct()
    {
        $this->db= new dbConnection;
    }

    public function addSupplier( $supplierName, $supplierContactName, $supplierEmail,$supplierContact, $supplierAdd1, $supplierAdd2, $supplierAdd3)
    {
        $today = date("Y-m-d");
        $conn = $this->db->connection();
        $sql = "INSERT INTO `supplier`(`supplier_name`, `supplier_contact_name`, `supplier_email`, `supplier_contact`, `supplier_add1`, `supplier_add2`, `supplier_add3`, `supplier_create_date`)
                VALUES('$supplierName', '$supplierContactName', '$supplierEmail','$supplierContact', '$supplierAdd1', '$supplierAdd2', '$supplierAdd3',' $today')";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getSupplierData()
    {
        $conn = $this->db->connection();
        $sql ="SELECT * FROM `supplier`";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function viewSupplierDetails($supplierId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT * FROM `supplier` WHERE `supplier_id` = '$supplierId'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function editSupplier($supplierId, $supplierName, $supplierContactName, $supplierEmail, $supplierContact, $supplierAdd1, $supplierAdd2, $supplierAdd3)
    {
        $conn = $this->db->connection();
        $sql ="UPDATE `supplier` SET `supplier_name`='$supplierName', `supplier_contact_name`='$supplierContactName', `supplier_email`='$supplierEmail', `supplier_contact`='$supplierContact', `supplier_add1`= '$supplierAdd1', `supplier_add2`= '$supplierAdd2',  `supplier_add3`= '$supplierAdd3' WHERE `supplier_id`='$supplierId'";
        $result =$conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getSupplierNameById($supplierId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `supplier_contact_name` FROM `supplier` WHERE `supplier_id` = '$supplierId'";
        $getGrnSupplierName = $conn->query($sql) or die($conn->error);
        return $getGrnSupplierName;
    }
    
    public function getSupplierBySupplierName($searchKey)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `supplier_id` , `supplier_contact_name` FROM `supplier` WHERE `supplier_name` LIKE '%$searchKey%'";
        $getSupplierBySupplierName = $conn->query($sql) or die($conn->error);
        return $getSupplierBySupplierName;
    }
}
?>
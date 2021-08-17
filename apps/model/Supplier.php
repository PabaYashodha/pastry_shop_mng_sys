<?php
include_once '../../config/dbConnection.php';
new dbConnection;

class Supplier
{
    public function addSupplier( $supplierName, $supplierContactName, $supplierEmail,$supplierContact, $supplierAdd1, $supplierAdd2, $supplierAdd3)
    {
        $today = date("Y-m-d");
        $conn = $GLOBALS['con'];
        $sql = "INSERT INTO `supplier`(`supplier_name`, `supplier_contact_name`, `supplier_email`, `supplier_contact`, `supplier_add1`, `supplier_add2`, `supplier_add3`, `supplier_create_date`)
                VALUES('$supplierName', '$supplierContactName', '$supplierEmail','$supplierContact', '$supplierAdd1', '$supplierAdd2', '$supplierAdd3',' $today')";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getSupplierData()
    {
        $conn = $GLOBALS['con'];
        $sql ="SELECT * FROM `supplier`";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function viewSupplierDetails($supplierId)
    {
        $conn = $GLOBALS['con'];
        $sql = "SELECT * FROM `supplier` WHERE `supplier_id` = '$supplierId'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function editSupplier($supplierId, $supplierName, $supplierContactName, $supplierEmail, $supplierContact, $supplierAdd1, $supplierAdd2, $supplierAdd3)
    {
        $conn = $GLOBALS['con'];
        $sql ="UPDATE `supplier` SET `supplier_name`='$supplierName', `supplier_contact_name`='$supplierContactName', `supplier_email`='$supplierEmail', `supplier_contact`='$supplierContact', `supplier_add1`= '$supplierAdd1', `supplier_add2`= '$supplierAdd2',  `supplier_add3`= '$supplierAdd3' WHERE `supplier_id`='$supplierId'";
        $result =$conn->query($sql) or die($conn->error);
        return $result;
    }
    
}
?>
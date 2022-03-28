<?php
include_once '../../config/dbConnection.php';

class Grn
{
    private $db;

    public function __construct()
    {
        $this->db = new dbConnection();
    }

    // public function newReference()
    // {
    //     $conn = $this->db->connection();
    //     $sql = "SELECT count(`grn_id`) FROM `grn`";
    //     $referenceId = $conn->query($sql);
    //     $row = $referenceId->num_rows;
    //     if ($row == 0) {
    //         $newRefId = "REF0001";
    //         return $newRefId;
    //     } else {
    //         $row = $referenceId->fetch_array();
    //         $count = $row[0];
    //         $count++;
    //         $newRefId = "REF" . str_pad($count, 5, "0", STR_PAD_LEFT);
    //         return $newRefId;
    //     }
    // }


    public function addGrn($referenceId, $grnDate, $grnPrice, $grnSupplierName)
    {
        $conn = $this->db->connection();
        $sql = "INSERT INTO `grn`(`grn_ref_id`, `grn_date`, `grn_price`,`supplier_supplier_id`)
                VALUES ('$referenceId','$grnDate', '$grnPrice', '$grnSupplierName')";
        $addGrn = $conn->query($sql) or die($conn->error);
        return $addGrn;        
    }

    public function getGrnData()
    {
        $conn = $this->db->connection();
        $sql = "SELECT * FROM `grn`";
        $getGrnData = $conn->query($sql) or die($conn->error);
        return $getGrnData;
    }

   public function changeGrnStatus($grnId,$grnStatus)
   {
    $conn = $this->db->connection();
    $sql = "UPDATE `grn` SET `grn_status`= '$grnStatus' WHERE `grn_id` = '$grnId' ";
    $changeGrnStatus = $conn->query($sql) or die($conn->error);
    return $changeGrnStatus;
   }

   public function viewGrnData($grnId)
   {
    $conn = $this->db->connection();
    $sql = "SELECT * FROM `grn` WHERE `grn_id`= '$grnId'";
    $viewGrnData = $conn->query($sql) or die($conn->error);
    return $viewGrnData;
   }
   
   public function editGrn($grnId, $grnDate, $grnPrice,$grnSupplierName)
   {
    $conn = $this->db->connection();
    $sql = "UPDATE `grn` SET `grn_date` = '$grnDate', `grn_price`='$grnPrice', `supplier_supplier_id`='$grnSupplierName' WHERE `grn_id`= '$grnId'";
    $editGrn = $conn->query($sql) or die($conn->error);
    return $editGrn;
   }
}

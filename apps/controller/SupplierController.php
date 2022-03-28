<?php
include_once '../model/Supplier.php';
$supplierObj = new Supplier();
$status = $_REQUEST['status'];

switch ($status) {
    case 'addSupplier':
        try {
            $supplierName = $_POST['supplierName'];
            $supplierContactName = $_POST['supplierContactName'];
            $supplierEmail = $_POST['supplierEmail'];
            $supplierContact = $_POST['supplierContact'];
            $supplierAdd1 = $_POST['supplierAdd2'];
            $supplierAdd2 = $_POST['supplierAdd2'];
            $supplierAdd3 = $_POST['supplierAdd3'];

            if ($supplierName == "") {
                throw new Exception("Supplier name is required");
            }
            if ($supplierContactName == "") {
                throw new Exception("Supplier contact name is required");
            }
            if ($supplierEmail == "") {
                throw new Exception("Email is required");
            }
            if ($supplierContact == "") {
                throw new Exception("Contact is required");
            }
            if ($supplierAdd1 == "") {
                throw new Exception("Address no is required");
            }
            if ($supplierAdd2 == "") {
                throw new Exception("Lane is required");
            }
            if ($supplierAdd3 == "") {
                throw new Exception("Street is required");
            }
            $result = $supplierObj->addSupplier($supplierName, $supplierContactName, $supplierEmail, $supplierContact, $supplierAdd1, $supplierAdd2, $supplierAdd3);
            if ($result == 1) {
                $res = 1;
                $result = $supplierObj->getSupplierData();
                $supplierArray = array();
                while ($row = $result->fetch_assoc()) {
                    array_push($supplierArray, $row);
                }
                $msg = $supplierArray;
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'getSupplierData':
        $result = $supplierObj->getSupplierData();
        $supplierArray = array();
        while ($row = $result->fetch_assoc()) {
            array_push($supplierArray, $row);
        }
        echo json_encode($supplierArray);
        break;

    case 'viewSupplierDetails':
        $supplierId = base64_decode($_POST['supplierId']);
        $result = $supplierObj->viewSupplierDetails($supplierId);
        $row = $result->fetch_assoc();
        echo json_encode($row);
        break;


    case 'editSupplier':
        try {
            $supplierId = base64_decode($_POST['editSupplierId']);
            $supplierName = $_POST['editSupplierName'];
            $supplierContactName = $_POST['editSupplierContactName'];
            $supplierEmail = $_POST['editSupplierEmail'];
            $supplierContact = $_POST['editSupplierContact'];
            $supplierAdd1 = $_POST['editSupplierAdd1'];
            $supplierAdd2 = $_POST['editSupplierAdd2'];
            $supplierAdd3 = $_POST['editSupplierAdd3'];

            if ($supplierName == "") {
                throw new Exception("Supplier name is required");
            }
            if ($supplierContactName == "") {
                throw new Exception("Supplier contact name  is required");
            }
            if ($supplierEmail == "") {
                throw new Exception("Supplier email is required");
            }
            if ($supplierContact == "") {
                throw new Exception("Supplier  contact is required");
            }
            if ($supplierAdd1 == "") {
                throw new Exception("address no  is required");
            }
            if ($supplierAdd2 == "") {
                throw new Exception("Lane  is required");
            }
            if ($supplierAdd3 == "") {
                throw new Exception("Street is required");
            }
            $result = $supplierObj->editSupplier($supplierId, $supplierName, $supplierContactName, $supplierEmail, $supplierContact, $supplierAdd1, $supplierAdd2, $supplierAdd3);
            if ($result == 1) {
                $res = 1;
                $getSupplierTbl = $supplierObj->getSupplierData();
                $supplierArray = array();
                while ($row = $getSupplierTbl->fetch_assoc()) {
                    array_push($supplierArray, $row);
                }
                $msg = $supplierArray;
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'getSupplierNameById':
        $supplierId = base64_decode($_GET['supplierId']);
        $getGrnSupplierName = $supplierObj->getSupplierNameById($supplierId);
        $row = $getGrnSupplierName->fetch_assoc();
        echo json_encode($row);
        break;

    case 'getSupplierBySupplierName':
        $searchKey = $_REQUEST['supplier'];
        $getSupplierBySupplierName = $supplierObj->getSupplierBySupplierName($searchKey);
        $searchResult[] = "";
        while ($row = $getSupplierBySupplierName->fetch_assoc()) {
           $searchResult[] = array(
               "id"=>$row['supplier_id'],
               "value" => $row['supplier_contact_name']
            );
        }
       echo json_encode($searchResult);
        break;
    
    
}

<?php
include_once '../model/Grn.php';
$grnObj = new Grn();
$status = $_REQUEST['status'];

switch ($status) {
    case 'addGrn':
        try {
            $grnDate = $_POST['grnDate'];
            $grnPrice = $_POST['grnPrice'];
            $grnSupplierName = $_POST['grnSupplierName'];

            if ($grnDate == "") {
                throw new Exception("Date is required");
            }
            if ($grnPrice == "") {
                throw new Exception("Price is required");
            }
            if ($grnSupplierName == "") {
                throw new Exception("Supplier name is required");
            }
            $referenceId = $grnObj->newReference();
            $addGrnData = $grnObj->addGrn($referenceId, $grnDate, $grnPrice, $grnSupplierName);
            if ($addGrnData == 1) {
                $res = 1;
                $getGrnData = $grnObj->getGrnData();
                $grnArray = array();
                while ($row = $getGrnData->fetch_assoc()) {
                    array_push($grnArray, $row);
                }
                $msg = $grnArray;
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'getGrnData':
        $getGrnData = $grnObj->getGrnData();
        $grnArray = array();
        while ($row = $getGrnData->fetch_assoc()) {
            array_push($grnArray, $row);
        }
        echo json_encode($grnArray);
        break;

    case 'changeGrnStatus':
        $grnId = base64_decode($_POST['grnId']);
        $grnStatus = $_POST['grnStatus'];
        $changeGrnStatus = $grnObj->changeGrnStatus($grnId, $grnStatus);
        if ($changeGrnStatus == 1) {
            $res = 1;
            $getGrnData = $grnObj->getGrnData();
            $grnArray = array();
            while ($row = $getGrnData->fetch_assoc()) {
                array_push($grnArray, $row);
            }
            $msg = $grnArray;
        } else {
            $res = 2;
            $msg = "Oops can't change status";
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'viewGrnDetails':
        $grnId = base64_decode($_POST['grnId']);
        $viewGrnData = $grnObj->viewGrnData($grnId);
        $row = $viewGrnData->fetch_assoc();
        echo json_encode($row);
        break;

    case 'editGrn':
        try {
            $grnId = base64_decode($_POST['editGrnId']);
            $grnDate = $_POST['editGrnDate'];
            $grnPrice = $_POST['editGrnPrice'];
            $grnSupplierName = $_POST['editGrnSupplierName'];

            if ($grnDate == "") {
                throw new Exception("Grn date is required");
            }
            if ($grnPrice == "") {
                throw new Exception("Price is required");
            }
            if ($grnSupplierName == "") {
                throw new Exception("Supplier name is required");
            }
            $editGrn = $grnObj->editGrn($grnId, $grnDate, $grnPrice, $grnSupplierName);
            if ($editGrn == 1) {
                $res = 1;
                $getGrnData = $grnObj->getGrnData();
                $grnArray = array();
                while ($row = $getGrnData->fetch_assoc()) {
                    array_push($grnArray, $row);
                }
                $msg = $grnArray;
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;
}

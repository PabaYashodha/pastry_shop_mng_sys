<?php
include_once '../model/Order.php';
$orderObj = new Order();
$status = $_REQUEST['status'];

switch ($status) {
    case 'addInvoice':
        try {
            //print_r($_POST);
            $invoiceFoodItemId = $_POST['invoiceFoodItemId'];
            $invoiceFoodItemUnitPrice = $_POST['invoiceFoodItemUnitPrice'];
            $invoiceFoodItemQuantity = $_POST['invoiceFoodItemQuantity'];
            //$invoiceDiscount = $_POST['invoiceDiscount'];
            $invoiceTotal = $_POST['invoiceTotal'];
            $invoiceSubAmount = $_POST['invoiceSubAmount'];
            $invoiceTotalDiscount = $_POST['invoiceTotalDiscount'];
            $invoiceNetTotal = $_POST['invoiceNetTotal'];
            $invoiceReceivedAmount = $_POST['invoiceReceivedAmount'];
            $invoiceBalanceAmount = $_POST['invoiceBalanceAmount'];


            if (empty($invoiceFoodItemId)) {
                throw new Exception("Food item name is required");
            }
            if (empty($invoiceFoodItemUnitPrice)) {
                throw new Exception("Unit price is required");
            }
            if (empty($invoiceFoodItemQuantity)) {
                throw new Exception("Please add ite quantity");
            }
            // if (empty($invoiceDiscount)) {
            //     throw new Exception("Discount is required");
            // }
            if (empty($invoiceTotal)) {
                throw new Exception("total is required");
            }
            if ($invoiceSubAmount == "") {
                throw new Exception("Sub amount is required");
            }
            if ($invoiceTotalDiscount == "") {
                throw new Exception("Total discount is required");
            }
            if ($invoiceNetTotal == "") {
                throw new Exception("Net total is required");
            }
            if ($invoiceReceivedAmount == "") {
                throw new Exception("Received quantity is required");
            }
            if ($invoiceBalanceAmount == "") {
                throw new Exception("Balance amount is required");
            }
            $addInvoice = $orderObj->addInvoice($invoiceSubAmount, $invoiceTotalDiscount, $invoiceNetTotal, $invoiceReceivedAmount, $invoiceBalanceAmount);
            // print_r($addInvoice);
            if ($addInvoice > 0) {
                foreach ($invoiceFoodItemId as $key => $value) {
                    $addSales = $orderObj->addSalesDetails($invoiceFoodItemQuantity[$key], $invoiceFoodItemUnitPrice[$key], base64_decode($value), $addInvoice);
                    if ($addSales != 1) {
                        throw new Exception("Item detail insertion failed");
                    }
                }
                $res = 1;
                $getInvoiceData = $orderObj->getInvoiceData();
                $orderArray = array();
                while ($row = $getInvoiceData->fetch_assoc()) {
                    array_push($orderArray, $row);
                }
                $msg = $orderArray;
            } else {
                throw new Exception("Item insertion failed");
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'getInvoiceData':
        $getInvoiceData = $orderObj->getInvoiceData();
        $orderArray = array();
        while ($row = $getInvoiceData->fetch_assoc()) {
            array_push($orderArray, $row);
        }
        echo json_encode($orderArray);
        break;

    case 'getNewOnlineOrderData':
        $getNewOnlineOrderData = $orderObj->getNewOnlineOrderData();
        $orderArray = array();
        while ($row = $getNewOnlineOrderData->fetch_assoc()) {
            $row['invoice_id'] = "INV".str_pad($row['invoice_id'], 6, "0", STR_PAD_LEFT);
            array_push($orderArray, $row);
        }
        echo json_encode($orderArray);
        break;


    // case 'viewManualOrderDetails':
    //     $invoiceId = $_POST['invoiceId'];
    //     $result = $orderObj->viewManualOrderDetails($invoiceId);
    //     $row = $result->fetch_assoc();
    //     echo json_encode($row);
    //     break;

    case 'viewOnlineOrderDetails':
        $invoiceId = intval(trim($_POST['invoiceId'], 'INV'));
        $result = $orderObj->viewOnlineOrderDetails($invoiceId);
        $row = $result->fetch_assoc();
        $row['invoice_id'] = "INV".str_pad($row['invoice_id'], 6, "0", STR_PAD_LEFT);
        echo json_encode($row);
        break;

    case 'viewFoodDetails':
        $OrderId = $_POST['orderId'];
        $viewOrderFoodItemDetails = $orderObj->viewFoodItemDetails($OrderId);
        //print_r($viewOrderFoodItemDetails);
        $orderArray = array();
        while ($row = $viewOrderFoodItemDetails->fetch_assoc()) {            
            array_push($orderArray, $row);
        }
        echo json_encode($orderArray);
        break;

    case 'getOnlineOrderData':
        $getOnlineOrderData = $orderObj->getOnlineOrderData();
        $orderArray = array();
        while ($row = $getOnlineOrderData->fetch_assoc()) {
            $row['invoice_id'] = "INV".str_pad($row['invoice_id'], 6, "0", STR_PAD_LEFT);
            array_push($orderArray, $row);
        }
        echo json_encode($orderArray);
        break;

    case 'changeOnlineOrderStatus':
        $invoiceId= intval(trim($_POST['invoiceId'], 'INV'));
        $ord_id = $_POST['orderId'];
        $onlineOrderStatus = $_POST['onlineOrderStatus'];
        $result = $orderObj->changeOnlineOrderStatus($invoiceId, $onlineOrderStatus, $ord_id);
        if ($result == 1) {
            $res = 1;
            $getOnlineOrderTbl = $orderObj->getOnlineOrderData();
            $orderArray = array();
            while ($row = $getOnlineOrderTbl->fetch_assoc()) {
                array_push($orderArray, $row);
            }
            $msg = $orderArray;
        } else {
            $res = 2;
            $msgs = "Oops can't change";
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

        // case 'viewOrderDetails':
        //     $OrderId = base64_decode($_POST['OrderId']);
        //     $viewOrder = $rowItemObj->viewOrderDetails($OrderId);
        //     $row = $viewOrder->fetch_assoc();
        //     echo json_encode($row);
        //     break;
        // case 'changeManualOrderStatus':
        //     $invoiceId = $_POST['invoiceId'];
        //     $manualOrderStatus = $_POST['manualOrderStatus'];
        //     $result = $orderObj->changeManualOrderStatus($invoiceId, $manualOrderStatus);
        //     if ($result==1) {
        //         $res=1;
        //         $getManualOrderTbl=$orderObj->getSalesData();
        //         $orderArray= array();
        //         while ($row= $getManualOrderTbl->fetch_assoc()) {
        //             array_push($orderArray,$row);
        //         }
        //         $msg = $orderArray;
        //     }else{
        //         $res=2;
        //         $msg = "Oops can't change";
        //     }
        //     $data[0]=$res;
        //     $data[1]=$msg;
        //     echo json_encode($data);
        //     break;

}

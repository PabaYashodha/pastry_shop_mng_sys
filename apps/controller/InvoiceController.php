<?php
include_once '../model/Invoice.php';
$invoiceObj = new Invoice();
$status = $_REQUEST['status'];

switch ($status) {
    case 'getOnlineInvoiceData':
        $result = $invoiceObj->getOnlineInvoiceData();
        $invoiceArray = array();
        while ($row = $result->fetch_assoc()) {
            array_push($invoiceArray, $row);
        }
        echo json_encode($invoiceArray);
        break;

    case 'viewOnlineOrderDetails':
        $invoiceId= $_POST['invoiceId'];
        $result = $invoiceObj->viewOnlineOrderDetails($invoiceId);
        $row = $result->fetch_assoc();
        echo json_encode($row);
        break;    

    case 'ViewFoodItem':
        $orderId = $_POST['orderId'];
        $result = $invoiceObj->viewFoodOrderDetails($orderId);
        $invoiceArray=array();
        while ($row= $result->fetch_assoc()) {
            array_push($invoiceArray,$row);
        }
        echo json_encode($invoiceArray);
        break;
        
       
    case 'getManualInvoiceData':
        $result = $invoiceObj->getManualInvoiceData();
        $invoiceArray=array();
        while ($row = $result->fetch_assoc()) {
            array_push($invoiceArray, $row);
        }
        echo json_encode($invoiceArray);
        break; 
    
    case 'viewManualOrderDetails':
        $invoiceId= $_POST['invoiceId'];
        $result = $invoiceObj->viewManualOrderDetails($invoiceId);
       // print_r($result);
        $row = $result->fetch_assoc();
        echo json_encode($row); 
        break;   
    
    case 'viewFoodSales':
        $invoiceId=$_POST['invoiceId'];
        $result = $invoiceObj->viewFoodSalesDetails($invoiceId);
        $invoiceArray=array();
        while ($row= $result->fetch_assoc()) {
            array_push($invoiceArray,$row);
        }
        echo json_encode($invoiceArray);
        break;
       
}

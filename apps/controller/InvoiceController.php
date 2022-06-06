<?php
include_once '../model/Invoice.php';
$invoiceObj = new Invoice();
$status = $_REQUEST['status'];

switch ($status) {

    case 'getInvoiceNumber':
        $getInvoiceNumber = $invoiceObj->getInvoiceNumber();
        $result = $getInvoiceNumber->fetch_assoc();
        $count = $result['count'];
        $count += 1;
        $newCount = "INV".str_pad($count, 6, "0", STR_PAD_LEFT);
        echo json_encode($newCount);
        break;

    case 'getOnlineInvoiceData':
        $result = $invoiceObj->getOnlineInvoiceData();
        $invoiceArray = array();
        while ($row = $result->fetch_assoc()) {
            $row['invoice_id'] = "INV".str_pad($row['invoice_id'], 6, "0", STR_PAD_LEFT);
            array_push($invoiceArray, $row);
        }
        echo json_encode($invoiceArray);
        break;

    case 'viewOnlineOrderDetails':
        $invoiceId= intval(trim($_POST['invoiceId'], 'INV'));
        $result = $invoiceObj->viewOnlineOrderDetails($invoiceId);
        $row = $result->fetch_assoc();
        $row['invoice_id'] = "INV".str_pad($row['invoice_id'], 6, "0", STR_PAD_LEFT);
        echo json_encode($row);
        break;    

        //online food details view
    case 'ViewFoodItem':
        $orderId = $_POST['orderId'];
        $result = $invoiceObj->viewFoodOrderDetails($orderId);
        //print_r($result);
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
             $row['invoice_id'] = "INV".str_pad($row['invoice_id'], 6, "0", STR_PAD_LEFT);
            array_push($invoiceArray, $row);
        }
        echo json_encode($invoiceArray);
        break; 
    
    case 'viewManualOrderDetails':
        $invoiceId= intval(trim($_POST['invoiceId'], 'INV'));
        // echo $invoiceId=$_POST['invoiceId'];
        
        $result = $invoiceObj->viewManualOrderDetails($invoiceId);
        $row = $result->fetch_assoc();
         $row['invoice_id'] = "INV".str_pad($row['invoice_id'], 6, "0", STR_PAD_LEFT);
        echo json_encode($row); 
        break;   
    
        //manual food details view
    case 'viewFoodSales':
        $invoiceId= intval(trim($_POST['invoiceId'], 'INV'));
        $result = $invoiceObj->viewFoodSalesDetails($invoiceId);
        $invoiceArray=array();
        while ($row= $result->fetch_assoc()) {
            array_push($invoiceArray,$row);
        }
        echo json_encode($invoiceArray);
        break;
       
}

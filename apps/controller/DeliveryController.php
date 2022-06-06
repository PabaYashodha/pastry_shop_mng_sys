<?php
include_once '../model/Delivery.php';
$deliveryObj = new Delivery(); //delivery object
$status = $_REQUEST['status'];

switch ($status) {
    case 'getReadyToDeliveryData':
       $getReadyToDeliveryData = $deliveryObj->getReadyToDeliveryData();
       $deliveryArray = array();
       while ($row= $getReadyToDeliveryData->fetch_assoc()) {
        $row['invoice_id'] = "INV".str_pad($row['invoice_id'], 6, "0", STR_PAD_LEFT);
           array_push($deliveryArray,$row);
       }
       echo json_encode($deliveryArray);
        break;

    case 'getAssignDeliveryData':
        $getAssignDeliveryData = $deliveryObj->getAssignDeliveryData();
        $deliveryArray = array();
        while ($row= $getAssignDeliveryData->fetch_assoc()) {
            $row['invoice_id'] = "INV".str_pad($row['invoice_id'], 6, "0", STR_PAD_LEFT);
            array_push($deliveryArray,$row);
        }
        echo json_encode($deliveryArray);
        break;    
    
    case 'getDeliveryPersonData':
        $deliverPersonData = $deliveryObj->getDeliveryPersonData();
        $deliveryArray=array();
        while ($row = $deliverPersonData->fetch_assoc()) {
            array_push($deliveryArray,$row);
        }
        echo json_encode($deliveryArray);
        break;
       
    case 'getOrderCompletedData':
        $getOrderCompletedData = $deliveryObj->getOrderCompletedData();
        $deliveryArray=array();
        while ($row = $getOrderCompletedData->fetch_assoc()) {
            $row['invoice_id'] = "INV".str_pad($row['invoice_id'], 6, "0", STR_PAD_LEFT);
            array_push($deliveryArray,$row);
        }
        echo json_encode($deliveryArray);
        break;    
   
    case 'getActiveDeliveryPersonData':
        $activeDeliveryPersonData= $deliveryObj->getActiveDeliveryPersonData();
        $deliveryArray= array();
        while ($row=$activeDeliveryPersonData->fetch_assoc()) {
            array_push($deliveryArray,$row);
        }
        echo json_encode($deliveryArray);
        break;  
        
    case 'addDelivery':
        try {
            $deliveryPerson = $_POST['deliveryPerson'];
            $orderId = $_POST['orderId'];
            if ($deliveryPerson == "") {
                throw new Exception("Delivery person is required");
            }
            if ($orderId=="") {
                throw new Exception("Order id is required");
            }
            $addDelivery = $deliveryObj->addDelivery($deliveryPerson,$orderId);
            if ($addDelivery==1) {
                $updateOrderStatus = $deliveryObj->updateOrderStatus($orderId);
                $res=1;
                $result=$deliveryObj->getDeliveryData();
                $deliveryArray=array();
                while ($row = $result->fetch_assoc()) {
                    array_push($deliveryArray, $row);
                }
                $msg = $deliveryArray;
            }
        } catch (Throwable $th) {
            $res =2 ;
            $msg= $th->getMessage();
        }
        $data[0]=$res;
        $data[1]=$msg;
        echo json_encode($data);
        break;   

    case 'viewDeliveryDetails':
        $userId = $_POST['userId'];
        $result = $deliveryObj->viewDeliveryDetails($userId);
        $row = $result->fetch_assoc();
        echo json_encode($row);
        break;    
}
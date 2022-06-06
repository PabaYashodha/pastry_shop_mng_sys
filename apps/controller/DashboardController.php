<?php
session_start();
include_once '../model/Dashboard.php';
$moduleObj = new Module();
$status = $_REQUEST['status'];

switch ($status) {
    case 'getModule':
     $userId = $_SESSION["user"]["user_id"];
      
        $result = $moduleObj->getModule($userId);
        $dashboardArray = array();
        while ($row = $result->fetch_assoc()) {
            array_push($dashboardArray, $row);
        }
        echo json_encode($dashboardArray);
        break;

    case 'getReorderCount':
        $result = $moduleObj->getReorderCount();
        $row = $result->fetch_assoc();
        echo json_encode($row['count']);
        break;  
        
    case 'getNewOrderCount':
        $result = $moduleObj->getNewOrderCount();
        //print_r($result);
        $row = $result->fetch_assoc();
        echo json_encode($row['count']);
        break;    

    case 'getPendingDeliveryCount':
        $result = $moduleObj->getPendingDeliveryCount();
        $row = $result->fetch_assoc();
        echo json_encode($row['count']);
        break; 
        
    case 'getTodayRevenue':
        $result = $moduleObj->getTodayRevenue();
        //print_r($result) ;
        $row = $result->fetch_assoc();
        echo json_encode($row['sum']);
        break;    
}

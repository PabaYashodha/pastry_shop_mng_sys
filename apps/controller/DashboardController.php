<?php
include_once '../model/Dashboard.php';
$moduleObj = new Module();
$status = $_REQUEST['status'];

switch ($status) {
    case 'getModule':
        $result = $moduleObj->getModule();
        $dashboardArray = array();
        while ($row = $result->fetch_assoc()) {
            array_push($dashboardArray, $row);
        }
        echo json_encode($dashboardArray);
        break;
}

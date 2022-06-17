<?php
include_once '../model/Chart.php';
$chartObj = new Chart();
$status = $_REQUEST['status'];

switch ($status) {
    case 'getPieChartValue':
        $result = $chartObj->getPieChartValue();
        $day = array();
        $sum = array();
        while ($row = $result->fetch_assoc()) {
            array_push($day, $row['dayName']);
            array_push($sum, (int)$row['total']);
        }
        $data[0] = $day;
        $data[1] = $sum;
        echo json_encode($data);
        break;

    case 'getColumChartValue':
        $result = $chartObj->getColumChartValue();
        $day = array();
        $sum = array();
        while ($row = $result->fetch_assoc()) {
            array_push($day, $row['monthName']);
            array_push($sum, (int)$row['total']);
        }
        $data[0] = $day;
        $data[1] = $sum;
        echo json_encode($data);
        break;
}

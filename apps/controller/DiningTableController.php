<?php
include_once '../model/DiningTable.php';
$DiningTableObj =  new DiningTable();
$status = $_REQUEST['status'];

switch ($status) {
    case 'addDiningTable':
        try {
            $tableName = $_POST['tableName'];
            $tableCapacity = $_POST['tableCapacity'];

            if ($tableName == "") {
                throw new Exception("Table name is required");
            }
            if ($tableCapacity == "") {
                throw new Exception("Table capacity is required");
            }
            $result = $DiningTableObj->addDiningTable($tableName, $tableCapacity);
            if ($result == 1) {
                $res = 1;
                $result = $DiningTableObj->getDiningTableData();
                $diningTableArray = array();
                while ($row = $result->fetch_assoc()) {
                    array_push($diningTableArray, $row);
                }
                $msg = $diningTableArray;
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'getDiningTableData':
        $result = $DiningTableObj->getDiningTableData();
        $diningTableArray = array();
        while ($row = $result->fetch_assoc()) {
            array_push($diningTableArray, $row);
        }
        echo json_encode($diningTableArray);
        break;

    case 'viewDiningTableDetails':
        $diningTableId = base64_decode($_POST['diningTableId']);
        $result = $DiningTableObj->viewDiningTableDetails($diningTableId);
        $row = $result->fetch_assoc();
        echo json_encode($row);
        break;

    case 'editDiningTable':
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
        break;
}

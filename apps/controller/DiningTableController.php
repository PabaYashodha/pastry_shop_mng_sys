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
            
            $duplicate = $DiningTableObj->existDiningTable($tableName);

            if ($duplicate == true) {
                throw new Exception("Table name already exist");
            }else{
                $result = $DiningTableObj->addDiningTable($tableName, $tableCapacity);
                if ($result == 1) {
                    $res = 1; 
                    $result = $DiningTableObj->getDiningTableData();
                    $diningTableArray = array();
                    while ($row = $result->fetch_assoc()) {
                        array_push($diningTableArray, $row);
                    }
                    $msg =serialize($diningTableArray) ;
                }else{
                    throw new Exception("Table name already exist");
                }
            }          
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = base64_encode($msg);
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
            $diningTableId = base64_decode($_POST['editDiningTableId']);
            $tableName = $_POST['editTableName'];
            $tableCapacity = $_POST['editTableCapacity'];

            if ($tableName == "") {
                throw new Exception("Table name is required");
            }
            if ($tableCapacity == "") {
                throw new Exception("Table capacity is required");
            }
            $result = $DiningTableObj->editDiningTable($diningTableId, $tableName, $tableCapacity);
            if ($result == 1) {
                $res = 1;
                $getDiningTableTbl = $DiningTableObj->getDiningTableData();
                $diningTableArray = array();
                while ($row = $getDiningTableTbl->fetch_assoc()) {
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

    case 'changeDiningTableStatus':
        $diningTableId = base64_decode($_POST['diningTableId']);
        $diningTableStatus = $_POST['diningTableStatus'];
        $result = $DiningTableObj->changeDiningTableStatus($diningTableId, $diningTableStatus);
        if ($result == 1) {
            $res = 1;
            $getDiningTableTbl = $DiningTableObj->getDiningTableData();
            $diningTableArray = array();
            while ($row = $getDiningTableTbl->fetch_assoc()) {
                array_push($diningTableArray, $row);
            }
            $msg = $diningTableArray;
        } else {
            $res = 2;
            $msg = "Oops! table can't deactivate";
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;
}

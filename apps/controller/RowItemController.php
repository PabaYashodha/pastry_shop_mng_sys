<?php
include_once '../model/RowItem.php';
$rowItemObj = new RowItem();
$status = $_REQUEST['status'];

switch ($status) {
    case 'addRowItem':
        try {
            $rowItemName = $_POST['rowItemName'];
            if ($rowItemName == "") {
                throw new Exception("Row Item Name is required");
            }
            $existRowItemName = $rowItemObj->existRowItemName($rowItemName);
            if ($existRowItemName->num_rows != 0) {
                throw new Exception("Row item name is already exist");
            }
            $addRowItem = $rowItemObj->addRowItem($rowItemName);
            if ($addRowItem == 1) {
                $res = 1;
                $getRowItemData = $rowItemObj->getRowItemData();
                $rowItemArray = array();
                while ($row = $getRowItemData->fetch_assoc()) {
                    array_push($rowItemArray, $row);
                }
                $msg = $rowItemArray;
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'getRowItemData':
        $getRowItemData = $rowItemObj->getRowItemData();
        $rowItemArray = array();
        while ($row = $getRowItemData->fetch_assoc()) {
            array_push($rowItemArray, $row);
        }
        echo json_encode($rowItemArray);
        break;

    case 'changeRowItemStatus':
        $rowItemId = base64_decode($_POST['rowItemId']);
        $rowItemStatus = $_POST['rowItemStatus'];
        $changeRowItemStatus = $rowItemObj->changeRowItemStatus($rowItemId, $rowItemStatus);
        if ($changeRowItemStatus == 1) {
            $res = 1;
            $getRowItemData = $rowItemObj->getRowItemData();
            $rowItemArray = array();
            while ($row = $getRowItemData->fetch_assoc()) {
                array_push($rowItemArray, $row);
            }
            $msg = $rowItemArray;
        } else {
            $res = 2;
            $msg = "Oops row item can't change";
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'viewRowItemDetails':
        $rowItemId = base64_decode($_POST['rowItemId']);
        $viewRowItem = $rowItemObj->viewRowItem($rowItemId);
        $row = $viewRowItem->fetch_assoc();
        echo json_encode($row);
        break;

    case 'editRowItem':
        try {
            $rowItemId = base64_decode($_POST['editRowItemId']);
            $rowItemName = $_POST['editRowItemName'];

            if ($rowItemName == "") {
                throw new Exception("Row item name is required");
            }
            $existRowItemName = $rowItemObj->existRowItemName($rowItemName);
            if ($existRowItemName->num_rows != 0) {
                throw new Exception("Row item name is already exist");
            }
            $editRowItem = $rowItemObj->editRowItem($rowItemId, $rowItemName);
            if ($editRowItem == 1) {
                $res = 1;
                $getRowItemData = $rowItemObj->getRowItemData();
                $rowItemArray = array();
                while ($row = $getRowItemData->fetch_assoc()) {
                    array_push($rowItemArray, $row);
                }
                $msg = $rowItemArray;
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

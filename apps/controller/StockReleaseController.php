<?php
include_once '../model/StockRelease.php';
$stockReleaseObj = new StockRelease();
$status = $_REQUEST['status'];

switch ($status) {
    case 'getStockReleaseNo':
        $getStockReleaseNo = $stockReleaseObj->getStockReleaseNo();
        $result = $getStockReleaseNo->fetch_assoc();
        $count = $result['count'];
        $count += 1;
        $newCount = "REL" . str_pad($count, 6, "0", STR_PAD_LEFT);
        echo json_encode($newCount);
        break;

    case 'addStockRelease':
        try {
            $stockReleaseDate = $_POST['stockReleaseDate'];
            $stockReleaseNo = $_POST['stockReleaseNo'];
            $stockReleaseTo = $_POST['stockReleaseTo'];
            $stockReleaseMadeBy = $_POST['stockReleaseMadeBy'];
            $stockReleaseRowItemId = $_POST['stockReleaseRowItemId'];
            $stockReleaseQuantity = $_POST['stockReleaseQuantity'];

            if ($stockReleaseDate == "") {
                throw new Exception("Release date is required");
            }
            if ($stockReleaseNo == "") {
                throw new Exception("Release no is required");
            }
            if ($stockReleaseTo == "") {
                throw new Exception("Release to is required");
            }
            if ($stockReleaseMadeBy == "") {
                throw new Exception("Stock release made by is required");
            }
            if (empty($stockReleaseRowItemId)) {
                throw new Exception("Release ro ite is required");
            }
            if (empty($stockReleaseQuantity)) {
                throw new Exception("Release quantity is required");
            }
            $addStockRelease = $stockReleaseObj->addStockRelease($stockReleaseDate, $stockReleaseNo, $stockReleaseTo, $stockReleaseMadeBy);
            if ($addStockRelease > 0) {
                foreach ($stockReleaseRowItemId as $key => $value)
                    $addStockReleaseItem = $stockReleaseObj->addStockReleaseItem($stockReleaseQuantity[$key], $value, $addStockRelease);
                    if ($addStockReleaseItem == 1) {
                    $res = 1;
                    $getStockReleaseData = $stockReleaseObj->getStockReleaseData();
                    $stockReleaseArray = array();
                    while ($row = $getStockReleaseData->fetch_assoc()) {
                        array_push($stockReleaseArray, $row);
                    }
                    $msg = $stockReleaseArray;
                }
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'getStockReleaseData':
        $getStockReleaseData = $stockReleaseObj->getStockReleaseData();
        //print_r($getStockReleaseData);
        $stockReleaseArray=array();
        while ($row = $getStockReleaseData->fetch_assoc()) {
            array_push($stockReleaseArray,$row);
        }
        echo json_encode($stockReleaseArray);
        break;    
}

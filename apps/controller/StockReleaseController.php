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
                foreach ($stockReleaseRowItemId as $key => $value) {
                    $quantity = $stockReleaseQuantity[$key];
                    $getRowItemStockById = $stockReleaseObj->getAvailableStockById($value);
                    while ($A_Qty = $getRowItemStockById->fetch_assoc()) {
                        $C_Qty = $A_Qty['stock_current_count'];
                        if ($C_Qty > $quantity) {
                            $currentCountGraterThanReleaseCount = $stockReleaseObj->currentCountGraterThanReleaseCount($A_Qty['stock_id'], $quantity);
                            break;
                        } elseif ($C_Qty == $quantity) {
                            $currentCountEqualTOReleaseCount = $stockReleaseObj->currentCountEqualTOReleaseCount($A_Qty['stock_id']);
                            break;
                        } elseif ($C_Qty < $quantity) {
                            $quantity = $quantity - $C_Qty;
                            $currentCountEqualTOReleaseCount = $stockReleaseObj->currentCountEqualTOReleaseCount($A_Qty['stock_id']);
                        }
                    }
                    $addStockReleaseItem = $stockReleaseObj->addStockReleaseItem($stockReleaseQuantity[$key], $value, $addStockRelease);
                    $stockReleaseObj->updateRowItemQtyById($stockReleaseQuantity[$key],$value);
                    if ($addStockReleaseItem != 1) {
                        throw new Exception("Release item insertion failed");
                    }
                }
                $res = 1;
                $getStockReleaseData = $stockReleaseObj->getStockReleaseData();
                $stockReleaseArray = array();
                while ($row = $getStockReleaseData->fetch_assoc()) {
                    array_push($stockReleaseArray, $row);
                }
                $msg = $stockReleaseArray;
            } else {
                throw new Exception("Stock Release insertion failed");
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
        $stockReleaseArray = array();
        while ($row = $getStockReleaseData->fetch_assoc()) {
            array_push($stockReleaseArray, $row);
        }
        echo json_encode($stockReleaseArray);
        break;

    case 'getAvailableRowItemName':
        $searchKey = $_REQUEST['rowItem'];
        $getAvailableRowItemName = $stockReleaseObj->availableStock($searchKey);
        $searchResult[] = "";
        while ($row = $getAvailableRowItemName->fetch_assoc()) {
            $searchResult[] = array(
                "id" => $row['row_item_id'],
                "value" => $row['row_item_name']
            );
        }
        echo json_encode($searchResult);
        break;
}

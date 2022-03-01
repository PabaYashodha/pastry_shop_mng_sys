<?php
include_once '../model/Stock.php';
$stockObj = new Stock();
$status = $_REQUEST['status'];

switch ($status) {
    case 'addStock':
        try {
            $stockRowItemName = $_POST['stockRowItemName'];
            $stockReferenceNo = $_POST['stockReferenceNo'];
            $stockAddingCount = $_POST['stockAddingCount'];
            $stockCurrentCount = $_POST['stockCurrentCount'];
            $stockCostPerUnit =$_POST['stockCostPerUnit'];
            $stockMnfData = $_POST['stockMnfData'];
            $stockExpDate = $_POST['stockExpDate'];

            if ($stockRowItemName == "") {
                throw new Exception("Row item name is required");
            }
            if ($stockReferenceNo=="") {
                throw new Exception("Stock reference id is required");
            }
            if ($stockAddingCount == "") {
                throw new Exception("Stock adding count is required");
            }
            if ($stockCurrentCount=="") {
                throw new Exception("Stock current count is required");
            }
            if ($stockCostPerUnit=="") {
                throw new Exception("Stock unit price s required");
            }
            if ($stockMnfData=="") {
                throw new Exception("Manufacture date is required");
            }
            if ($stockExpDate=="") {
                throw new Exception("Expire date is required");
            }
            // $existReferenceId = $stockObj->existReferenceId($stockReferenceNo);
            // if ($existReferenceId->num_rows ==0) {
            //     throw new Exception("Reference Id isn't correct ");
            // }
            $addStock = $stockObj->addStock($stockRowItemName,$stockReferenceNo,$stockAddingCount,$stockCurrentCount,$stockCostPerUnit,$stockMnfData,$stockExpDate);
            if ($addStock==1) {
                $res=1;
                $getStockData = $stockObj->getStockData();
                $stockArray = array();
                while ($row = $getStockData->fetch_assoc()) {
                    array_push($stockArray, $row);
                }
                $msg = $stockArray;
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0]=$res;
        $data[1]=$msg;
        echo json_encode($data);
        break;
    
  
}
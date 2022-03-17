<?php
include_once '../model/Stock.php';
$stockObj = new Stock();
$status = $_REQUEST['status'];

switch ($status) {
    case 'addStock':
        try {
            $stockSupplierName = $_POST['stockSupplierName'];
            $stockCreateDate = $_POST['stockCreteDate'];
            $stockReferenceNo = $_POST['stockReferenceNo'];
            $stockRowItemId=$_POST['stockTableRowItemId'];
            $stockMnfData=$_POST['stockTableMnfDate'];
            $stockExpDate=$_POST['stockTableExpDate'];
            $stockReceivedQuantity=$_POST['stockTableReceivedQuantity'];
            $stockCostPerUnit=$_POST['stockTableCostPerUnit'];
            $stockTotalCost = $_POST['stockTotalCost'];//total without discount
            $stockDiscount =$_POST['stockTableDiscount']; // for each product discount
            $stockTableNetCost = $_POST['stockTableNetCost'];//for one product total cost
            $stockTotalDiscount=$_POST['stockTotalDiscount']; // total discount
            $stockNetTotal=$_POST['stockNetTotal'];//total with discount
            
            if ($stockSupplierName== "") {
                throw new Exception("Supplier name is required");
            }
            if ($stockReferenceNo=="") {
                throw new Exception("Stock reference id is required");
            }
            if ($stockCreateDate == "") {
                throw new Exception("Stock date is required");
            }
            if ($stockNetTotal=="") {
                throw new Exception("net cost is required");
            }
            //insert id return to the $addGrn
            $addGrn = $stockObj->addGrn($stockSupplierName,$stockReferenceNo,$stockCreateDate,$stockNetTotal, $stockTotalDiscount);
            if ($addGrn > 0) {
                foreach ($stockRowItemId as $key => $value) {
                    $addStock = $stockObj->addStock($stockReceivedQuantity[$key],$stockCostPerUnit[$key],$stockDiscount[$key],$stockMnfData[$key],$stockExpDate[$key],$stockTableNetCost[$key],$value, $addGrn);
                }
            }

            // $existReferenceId = $stockObj->existReferenceId($stockReferenceNo);
            // if ($existReferenceId->num_rows ==0) {
            //     throw new Exception("Reference Id isn't correct ");
            // }
           // $addStock = $stockObj->addStock($stockRowItemName,$stockReferenceNo,$stockAddingCount,$stockCurrentCount,$stockCostPerUnit,$stockMnfData,$stockExpDate);
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
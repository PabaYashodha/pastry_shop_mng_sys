<?php
include_once '../model/Stock.php';
$stockObj = new Stock();
$status = $_REQUEST['status'];

switch ($status) {
    case 'getGrnNumber':
        $getGrnNumber = $stockObj->getGrnNumber();
        $result = $getGrnNumber->fetch_assoc();
        $count = $result['count'];
        $count += 1;
        $newCount = "GRN".str_pad($count, 6, "0", STR_PAD_LEFT);
        echo json_encode($newCount);
        break;

    case 'addStock':
        try {
            $stockSupplierId = $_POST['stockSupplierId'];
            $stockCreateDate = $_POST['stockCreteDate'];
            $stockReferenceNumber = $_POST['stockReferenceNumber'];
            $stockGrnNumber = $_POST['stockGrnNumber'];
            $stockRowItemId=$_POST['stockTableRowItemId'];
            $stockMnfData=$_POST['stockTableMnfDate'];
            $stockExpDate=$_POST['stockTableExpDate'];
            $stockReceivedQuantity=$_POST['stockTableReceivedQuantity'];
            $stockCostPerUnit=$_POST['stockTableCostPerUnit'];
            $stockDiscount= $_POST['stockTableDiscount'];
            $stockNetCost =$_POST['stockTableNetCost'];
            $stockTotalCost = $_POST['stockTotalCost'];
            $stockTotalDiscount = $_POST['stockTotalDiscount'];
            $stockNetTotal = $_POST['stockNetTotal'];
           
            
            if ($stockSupplierId== "") {
                throw new Exception("Supplier name is required");
            }
            if ($stockReferenceNumber=="") {
                throw new Exception("Stock reference id is required");
            }
            if ($stockCreateDate == "") {
                throw new Exception("Stock date is required");
            }
            if (empty($stockRowItemId)) {
                throw new Exception("Row item is required");
            }
            if (empty($stockMnfData)) {
                throw new Exception("Mnf date is required");
            }
            if (empty($stockExpDate)) {
                throw new Exception("Exp date is required");
            }
            if (empty($stockReceivedQuantity)) {
                throw new Exception("Stock received quantity");
            }
            if (empty($stockCostPerUnit)) {
                throw new Exception("Cost per unit is required");
            }
            if (empty($stockDiscount)) {
                throw new Exception("Discount is required");
            }
            if (empty($stockNetCost)) {
                throw new Exception("stock net cost is required");
            }
            if ($stockTotalCost == "") {
                throw new Exception("Total cost is required");
            }
            if ($stockTotalDiscount == "") {
                throw new Exception("Total discount is required");
            }
            if ($stockNetTotal== "") {
                throw new Exception("Net total is required");
            }
            $addGrn = $stockObj->addGrn($stockSupplierId, $stockCreateDate, $stockReferenceNumber,$stockTotalDiscount, $stockNetTotal);
            // if ($addGrn>0) {
                
            // }
            
        //     //insert id return to the $addGrn
        //     $addGrn = $stockObj->addGrn($stockSupplierName,$stockReferenceNo,$stockCreateDate,$stockNetTotal, $stockTotalDiscount);
        //     if ($addGrn > 0) {
        //         foreach ($stockRowItemId as $key => $value) {
        //             $addStock = $stockObj->addStock($stockReceivedQuantity[$key],$stockCostPerUnit[$key],$stockDiscount[$key],$stockMnfData[$key],$stockExpDate[$key],$stockTableNetCost[$key],$value, $addGrn);
        //         }
        //     }

        //     // $existReferenceId = $stockObj->existReferenceId($stockReferenceNo);
        //     // if ($existReferenceId->num_rows ==0) {
        //     //     throw new Exception("Reference Id isn't correct ");
        //     // }
        //    // $addStock = $stockObj->addStock($stockRowItemName,$stockReferenceNo,$stockAddingCount,$stockCurrentCount,$stockCostPerUnit,$stockMnfData,$stockExpDate);
        //     if ($addStock==1) {
        //         $res=1;
        //         $getStockData = $stockObj->getStockData();
        //         $stockArray = array();
        //         while ($row = $getStockData->fetch_assoc()) {
        //             array_push($stockArray, $row);
        //         }
        //         $msg = $stockArray;
        //     }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0]=$res;
        $data[1]=$msg;
        echo json_encode($data);
        break;
    
  
}
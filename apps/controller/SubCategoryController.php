<?php
include_once '../model/SubCategory.php';
$subCategoryObj = new subCategory;
$status = $_REQUEST['status'];

switch ($status) {
    case 'addSubCategory':
      try {
          $subCategoryName = $_POST['subCategoryName'];
          $subCategoryCategoryItems = $_POST['subCategoryCategoryItems'];
    
          if ($subCategoryName == "") {
              throw new Exception("Sub category name is required");
          }
          if ($subCategoryCategoryItems== "") {
              throw new Exception("category name is required");
          }
          $existSubCategoryName = $subCategoryObj->existSubCategory($subCategoryName);
          if ($existSubCategoryName->num_rows !=0) {
              throw new Exception("Sub category name is already existed");
          }
          $addSubCategory = $subCategoryObj->addSubCategory($subCategoryName,$subCategoryCategoryItems);
          if ($addSubCategory == 1) {
              $res=1;
              $getSubCategoryData = $subCategoryObj->getSubCategoryData();
              $subCategoryArray = array();
              while ($row = $getSubCategoryData->fetch_assoc()) {
                  array_push($subCategoryArray, $row);
              }
              $msg= $subCategoryArray;
          }
      } catch (Throwable $th) {
          $res =2;
          $msg =$th->getMessage();
      }
      $data[0] = $res;
      $data[1] = $msg;
      echo json_encode($data);
        break;

    case 'getSubCategoryData':
        $getSubCategoryData = $subCategoryObj->getSubCategoryData();
        $subCategoryArray = array();
        while ($row = $getSubCategoryData-> fetch_assoc()) {
            array_push($subCategoryArray, $row);
        }
        echo json_encode($subCategoryArray);
        break;    
}
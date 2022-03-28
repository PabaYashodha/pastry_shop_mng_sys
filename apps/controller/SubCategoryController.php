<?php
include_once '../model/SubCategory.php';
$subCategoryObj = new subCategory;
$status = $_REQUEST['status'];

switch ($status) {
    case 'addSubCategory':
        try {
            $subCategoryName = $_POST['subCategoryName'];
            $subCategoryCategoryItem = $_POST['subCategoryCategoryItem'];

            if ($subCategoryName == "") {
                throw new Exception("Sub category name is required");
            }
            if ($subCategoryCategoryItem == "") {
                throw new Exception("category name is required");
            }
            $existSubCategoryName = $subCategoryObj->existSubCategory($subCategoryName);
            if ($existSubCategoryName->num_rows != 0) {
                throw new Exception("Sub category name is already existed");
            }
            if ($_FILES["subCategoryImage"]["name"] != "") {
                $subCategoryImage = $_FILES["subCategoryImage"]["name"];
                $foodItemImageExt = substr($subCategoryImage, strrpos($subCategoryImage, '.'));
                $subCategoryImage = time() . $foodItemImageExt;
                $temp_loc = $_FILES["subCategoryImage"]["tmp_name"];
                $new_loc = "../../images/foodItem-images/$subCategoryImage";
                move_uploaded_file($temp_loc, $new_loc);
            } else {
                throw new Exception("image is required");
            }
            $addSubCategory = $subCategoryObj->addSubCategory($subCategoryName, $subCategoryCategoryItem,$subCategoryImage);
            if ($addSubCategory == 1) {
                $res = 1;
                $getSubCategoryData = $subCategoryObj->getSubCategoryData();
                $subCategoryArray = array();
                while ($row = $getSubCategoryData->fetch_assoc()) {
                    array_push($subCategoryArray, $row);
                }
                $msg = $subCategoryArray;
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'getSubCategoryData':
        $getSubCategoryData = $subCategoryObj->getSubCategoryData();
        $subCategoryArray = array();
        while ($row = $getSubCategoryData->fetch_assoc()) {
            array_push($subCategoryArray, $row);
        }
        echo json_encode($subCategoryArray);
        break;

    case 'viewSubCategoryDetails':
        $subcategoryId = base64_decode($_POST['subCategoryId']);
        $viewSubCategory = $subCategoryObj->viewSubCategoryData($subcategoryId);
        $row = $viewSubCategory->fetch_assoc();
        echo json_encode($row);
        break;

    case 'editSubCategory':
        try {
            $subCategoryId = base64_decode($_POST['editSubCategoryId']);
            $subCategoryName = $_POST['editSubCategoryName'];
            $subCategoryCategoryItem = $_POST['editSubCategoryCategoryItem'];
            $subCategoryImage = "";

            if ($subCategoryName == "") {
                throw new Exception("Sub category name is required");
            }
            $existEditSubCategoryName = $subCategoryObj->existEditSubCategory($subCategoryName);
            if ($existEditSubCategoryName ==false ) {
                throw new Exception("Sub category name is already existed");
            }
            if ($subCategoryCategoryItem == "") {
                throw new Exception("Category name is required");
            }
            if ($_FILES["editSubCategoryImage"]["name"]!= "") {
                $subCategoryImage = $_FILES["editSubCategoryImage"]["name"];
                $foodItemImageExt = substr($subCategoryImage, strrpos($subCategoryImage, '.'));
                $subCategoryImage = time(). $foodItemImageExt;
                $temp_loc =$_FILES["editSubCategoryImage"]["tmp_name"];
                $new_loc = "../../images/foodItem-images/$subCategoryImage";
                move_uploaded_file($temp_loc, $new_loc);
            }
            $editSubCategory = $subCategoryObj->editSubCategory($subCategoryId, $subCategoryName, $subCategoryCategoryItem,$subCategoryImage);
            if ($editSubCategory == 1) {
                $res = 1;
                $getSubCategoryData = $subCategoryObj->getSubCategoryData();
                $subCategoryArray = array();
                while ($row = $getSubCategoryData->fetch_assoc()) {
                    array_push($subCategoryArray, $row);
                }
                $msg = $subCategoryArray;
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'changeSubCategoryStatus':
        $subCategoryId = base64_decode($_POST['subCategoryId']);
        $subCategoryStatus = $_POST['subCategoryStatus'];
        $changeSubCategoryStatus = $subCategoryObj->changeSubCategoryStatus($subCategoryId, $subCategoryStatus);
        if ($changeSubCategoryStatus == 1) {
            $res = 1;
            $getSubCategoryData = $subCategoryObj->getSubCategoryData();
            $subCategoryArray = array();
            while ($row = $getSubCategoryData->fetch_assoc()) {
                array_push($subCategoryArray, $row);
            }
            $msg = $subCategoryArray;
        } else {
            $res = 2;
            $msg = "Oops sub category can't change";
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'deleteCategory':
        $subCategoryId = base64_decode($_POST['subCategoryId']);
        $deleteSubCategory = $subCategoryObj->deleteSubCategory($subCategoryId);
        if ($deleteSubCategory == 1) {
            $res = 1;
            $getSubCategoryData = $subCategoryObj->getSubCategoryData();
            $subCategoryArray = array();
            while ($row = $getSubCategoryData->fetch_assoc()) {
                array_push($subCategoryArray, $row);
            }
            $msg = $subCategoryArray;
        } else {
            $res = 2;
            $ms = "Oops sub category can't delete";
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'getSubCategoryById':
        $subCategoryId= base64_decode($_GET['subCategoryId']);
        $getSubCategoryName = $subCategoryObj->getSubCategoryById($subCategoryId);
        $row = $getSubCategoryName->fetch_assoc();
        echo json_encode($row);
        break;
}

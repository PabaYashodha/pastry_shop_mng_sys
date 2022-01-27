<?php
include_once '../model/Category.php';
$categoryObj = new category;
$status = $_REQUEST['status'];

switch ($status) {
    case 'addCategory':
        try {
            $categoryName = $_POST['categoryName'];

            if ($categoryName == "") {
                throw new Exception("Category Name is required");
            }
            $existCategory = $categoryObj->existCategory($categoryName);
            if ($existCategory->num_rows != 0) {
                throw new Exception("Category name is already exist");
            }
            $addCategoryData = $categoryObj->addCategory($categoryName);
            if ($addCategoryData == 1) {
                $res = 1;
                $getCategoryData = $categoryObj->getCategoryData();
                $categoryArray = array();
                while ($row = $getCategoryData->fetch_assoc()) {
                    array_push($categoryArray, $row);
                }
                $msg = $categoryArray;
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'getCategoryData':
        $getCategoryData = $categoryObj->getCategoryData();
        $categoryArray = array();
        while ($row = $getCategoryData->fetch_assoc()) {
            array_push($categoryArray, $row);
        }
        echo json_encode($categoryArray);
        break;

    case 'getCategoryById':
        $categoryId = base64_decode($_GET['categoryId']);
        $getCategoryName = $categoryObj->getCategoryById($categoryId);
        $row = $getCategoryName->fetch_assoc();
        echo json_encode($row);
        break;

    case 'viewCategoryDetails':
        $categoryId = base64_decode($_POST['categoryId']);
        $viewCategory = $categoryObj->viewCategoryDetails($categoryId);
        $row =  $viewCategory->fetch_assoc();
        echo json_encode($row);
        break;

    case 'editCategory':
        try {
            $categoryId = base64_decode($_POST['editCategoryId']);
            $categoryName = $_POST['editCategoryName'];

            if ($categoryName == "") {
                throw new Exception("Category name is required");
            }
            $existCategory = $categoryObj->existCategory($categoryName);
            if ($existCategory->num_rows != 0) {
                throw new Exception("Category name is already exist");
            }
            $editCategory = $categoryObj->editCategory($categoryId, $categoryName);
            if ($editCategory == 1) {
                $res = 1;
                $getCategoryData = $categoryObj->getCategoryData();
                $categoryArray = array();
                while ($row = $getCategoryData->fetch_assoc()) {
                    array_push($categoryArray, $row);
                }
                $msg = $categoryArray;
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'changeCategoryStatus':
        $categoryId = base64_decode($_POST['categoryId']);
        $categoryStatus = $_POST['categoryStatus'];
        $changeCategoryStatus = $categoryObj->changeCategoryStatus($categoryId, $categoryStatus);
        if ($changeCategoryStatus == 1) {
            $res = 1;
            $getCategoryData = $categoryObj->getCategoryData();
            $categoryArray = array();
            while ($row = $getCategoryData->fetch_assoc()) {
                array_push($categoryArray, $row);
            }
            $msg = $categoryArray;
        } else {
            $res = 2;
            $msg = "Oops category can't change";
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;

    case 'deleteCategory':
        $categoryId = base64_decode($_POST['categoryId']);
        $deleteCategory = $categoryObj->deleteCategory($categoryId);
        if ($deleteCategory == 1) {
            $res = 1;
            $getCategoryData = $categoryObj->getCategoryData();
            $categoryArray = array();
            while ($row = $getCategoryData->fetch_assoc()) {
                array_push($categoryArray, $row);
            }
            $msg = $categoryArray;
        } else {
            $res = 2;
            $ms = "Oops category can't delete";
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;
}

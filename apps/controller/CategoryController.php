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
}

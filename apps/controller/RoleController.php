<?php
include_once '../model/Role.php';
$roleObj = new Role();
$status = $_REQUEST['status'];

switch ($status) {
    case 'getRoleNameById':
        $roleId = base64_decode($_GET['roleId']);
        $roleName = $roleObj->getRoleNameById($roleId);
        $row = $roleName->fetch_assoc();
        echo json_encode($row);
        break;

    case 'getRole':
        $getRole = $roleObj->getRole();
        $roleArray = array();
        while ($row = $getRole->fetch_assoc()) {
            array_push($roleArray,$row);
        }
        echo json_encode($roleArray);
        break;    
}

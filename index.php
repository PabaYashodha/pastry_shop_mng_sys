<?php
if(!empty($_SERVER['HTTPS']) && ('on'==$_SERVER['HTTPS'])){
    $url = 'https://';
}else{
    $url = 'https://';
}
$url .= $_SERVER['HTTP_HOST']; // https://localhost
header('Location:'.$url.'/pastry_shop_mng_sys/apps/view/login.php');
exit;
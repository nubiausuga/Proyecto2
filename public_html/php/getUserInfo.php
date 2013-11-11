<?php

include '../DAO/DAOs.php';

$dao = new DAOs();

session_start();
$user = $_SESSION['user'];
$in = $_SESSION['access'];

if($in){
    
    $infoArr = $dao->getUserInfo($user);
    $bal = $dao->getBalance($user);
    $estado = $dao->getEstadoCuenta($user);
    $chop = substr($infoArr, 0, -1);
    $json = $chop . ",\"Balance\":\"" . $bal . "\",\"Estado\":\"" . $estado . "\"}";

    echo $json;
    
}else{
    echo -1;
}
    

/*
if (!empty($_POST['postuser'])) {

    $userCode = $_POST['postuser'];
    $infoArr = $dao->getUserInfo($userCode);
    $bal = $dao->getBalance($userCode);
    $estado = $dao->getEstadoCuenta($userCode);
    $chop = substr($infoArr, 0, -1);
    $json = $chop . ",\"Balance\":\"" . $bal . "\",\"Estado\":\"" . $estado . "\"}";

    echo $json;
}else{
    echo -1;
}
 * 
 */

/*
$cod = 201010013010;
$infoArr = $dao->getUserInfo($cod);
$bal = $dao->getBalance($cod);
$estado = $dao->getEstadoCuenta($cod);

$chop = substr($infoArr, 0,-1);
$json = $chop.",\"Balance\":\"".$bal."\",\"Estado\":\"".$estado."\"}";

echo $json;
 * 
 */
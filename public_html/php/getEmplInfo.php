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
    $emplInfo = $dao->getEmplExtraInfo($user);
    $chop = substr($infoArr, 0, -1);
    $chop2 = substr($emplInfo, 1);
   // $json = $chop . ",\"Balance\":\"" . $bal . "\",\"Estado\":\"" . $estado . "\"}";
    $json = $chop . ",\"Balance\":\"" . $bal . "\",\"Estado\":\"" . $estado . "\",".$chop2;
    echo $json;
    
}else{
    echo -1;
}
    

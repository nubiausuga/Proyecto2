<?php

include '../DAO/DAOs.php';

$dao = new DAOs();

$cod = 201010013010;
$infoArr = $dao->getUserInfo($cod);
$bal = $dao->getBalance($cod);
$estado = $dao->getEstadoCuenta($cod);

$chop = substr($infoArr, 0,-1);
$json = $chop.",\"Balance\":\"".$bal."\",\"Estado\":\"".$estado."\"}";

echo $json;
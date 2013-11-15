<?php

include '../DAO/DAOs.php';

$daos = new DAOs();

session_start();
$admin = $_SESSION['user'];

//get establecimiento al que pertenece
$idEstablecimiento = $daos->getIdEstablecimiento($admin);

if(!empty($_POST['postini']) && !empty($_POST['postfin'])){
    
    $ini = $_POST['postini'];
    $fin = $_POST['postfin'];
    
    echo $daos->getFacturasByFecha($idEstablecimiento, $ini, $fin);
    
}else{
    return -1;
}
<?php

include '../DAO/DAOs.php';

$daos = new DAOs();

session_start();
$admin = $_SESSION['user'];

//get establecimiento al que pertenece
$idEstablecimiento = $daos->getIdEstablecimiento($admin);

if(!empty($_POST['postid'])){
    
    $idFactura = $_POST['postid'];
    
    echo $daos->getProdPorFactura($idFactura);
}else{
    return -1;
}
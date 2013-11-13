<?php

include '../DAO/DAOs.php';

$regCompra = new DAOs();
session_start();
$currentEmployee = $_SESSION['user'];

if(!empty($_POST['postProd']) && !empty($_POST['postPrices'])
        && !empty($_POST['postcode'])){
    
    $prodList = $_POST['postProd'];
    $listPrices = $_POST['postPrices'];
    $currentUser = $_POST['postcode'];
    
    //obtener Id Establecimiento
    $estName = $regCompra->getEstablishmentName($currentEmployee);
    $estId = $regCompra->getIdEstEmployee($estName);
    
    //obtener valor total a descontar
    $total = 0;
    for($i = 0; $i < count($listPrices);$i++){
        $total += $listPrices[$i];
    }
    
    
}else{
    echo -1;
}


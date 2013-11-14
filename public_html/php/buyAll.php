<?php

include '../DAO/DAOs.php';
include '../Cuentas/Cuenta.php';
include '../Cuentas/Movimiento.php';

$regCompra = new DAOs();

session_start();
$currentEmployee = $_SESSION['user'];

if (!empty($_POST['postProd']) && !empty($_POST['postPrices'])
        && !empty($_POST['postcode']) && !empty($_POST['posttotal'])) {

    $prodList = $_POST['postProd'];
    $listPrices = $_POST['postPrices'];
    $currentUser = $_POST['postcode'];
    $total = $_POST['posttotal'];
    
    //obtener Id Establecimiento
    $estName = $regCompra->getEstablishmentName($currentEmployee);
    $estId = $regCompra->getIdEstEmployee($estName);

    /*
    //obtener valor total a descontar
    $total = 0;
    for ($i = 0; $i < count($listPrices); $i++) {
        $total += $listPrices[$i];
    }
    */
    
    //fecha
    $datetime = date("Y-m-d H:i:s");

    //crear movimiento
    $rand = rand(0, 9999999999);
    $newMov = new Movimiento($rand, $estId, $prodList, $datetime,
            $total, $currentUser);

    //agregar factura a la base de datos
    $regCompra->addFactura($newMov->getFechaMovimiento(), 
            $newMov->getValorMovimiento(), 1, $total, 0.0, $currentUser,
            $estId, $currentEmployee);

    //obtener idFactura
    $idFactura = $regCompra->getFacId($newMov->getFechaMovimiento());

    //add to has factura
    $codes = [];

    for ($i = 0; $i < count($prodList); $i++) {
        $codes[$i] = $regCompra->getIdProdByName($prodList[$i]);
    }

    for ($j = 0; $j < count($codes); $j++) {
        $regCompra->addToHasProducto($idFactura, $codes[$j]);
    }
    
    //descontar de cuenta
    $currentBalance = (double)$regCompra->getBalance($currentUser);
    $newBalance = (double)$currentBalance - (double)$total;
    echo $regCompra->modifyBalance($currentUser, $newBalance);
    
} else {
    echo -1;
}


<?php

include '../DAO/DAOs.php';
include '../Cuentas/Cuenta.php';
include '../Cuentas/Movimiento.php';

$regCompra = new DAOs();

session_start();
$currentEmployee = $_SESSION['user'];

if (!empty($_POST['postProd']) && !empty($_POST['postPrices'])
        && !empty($_POST['postcode'])) {

    $prodList = $_POST['postProd'];
    $listPrices = $_POST['postPrices'];
    $currentUser = $_POST['postcode'];

    //obtener Id Establecimiento
    $estName = $regCompra->getEstablishmentName($currentEmployee);
    $estId = $regCompra->getIdEstEmployee($estName);

    //obtener valor total a descontar
    $total = 0;
    for ($i = 0; $i < count($listPrices); $i++) {
        $total += $listPrices[$i];
    }

    //fecha
    $datetime = date("Y-m-d H:i:s");

    //crear movimiento
    $rand = rand(0, 9999999999);
    $newMov = new Movimiento($rand, $estId, $prodList,
            $datetime, $total, $currentUser);

    //descontar de cuenta
    $currentBalance = $regCompra->getBalance($currentUser);
    $newBalance = $currentBalance - $total;
    $regCompra->modifyBalance($currentUser, $newBalance);

    //agregar factura a la base de datos
    echo ($regCompra->addFactura($newMov->getFechaMovimiento(),
            $newMov->getValorMovimiento(), 1, $total, 0.0, $currentUser,
            $estId, $currentEmployee));
    
} else {
    echo -1;
}


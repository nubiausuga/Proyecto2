<?php

include '../DAO/DAOs.php';
include '../Cuentas/Cuenta.php';
include '../Cuentas/Movimiento.php';

$dao = new DAOs();

if (!empty($_POST['postcode']) && !empty($_POST['postproduct']) && !empty($_POST['postq'])) {

    $id = $_POST['postcode'];
    $productId = $_POST['postproduct'];
    $quantity = $_POST['postq'];

    $saldoActual = $dao->getBalance($id);

    if ($saldoActual != null) {

        $pInfo = $dao->getProdInfo($productId);
        $obj = json_decode($pInfo);
        $prodPrice = $obj->{'Prod_ValorUnitario'};
        $prodName = $obj->{'Prod_Descripcion'};

        $valorActual = $saldoActual - ($prodPrice * $quantity);

        $arr = array('SaldoActual' => $saldoActual,
            'PrecioProducto' => $prodPrice, 'NombreProducto' => $prodName,
            'Q' => $quantity, 'Remain' => $valorActual);

        echo json_encode($arr);
    } else {
        echo -1;
    }
} else {
    echo -1;
}


<?php

include_once '../DAO/DAOs.php';
include '../Establecimientos/Producto.php';

$reg = new DAOs();

if (!empty($_POST['postid']) && !empty($_POST['postdesc']) &&
        !empty($_POST['postvalue']) && !empty($_POST['postmarca'])) {

    $idProduct = (int)$_POST['postid'];
    $descriptionProduct = $_POST['postdesc'];
    $valueProduct = (double)$_POST['postvalue'];
    $marcaProd = $_POST['postmarca'];

    $newProd = new Producto($idProduct, $descriptionProduct,
            $valueProduct, $marcaProd);
    
    echo $reg->nuevoProducto($newProd->getIdProducto(),
            $newProd->getDescProducto(), $newProd->getPrecioProducto(),
            $newProd->getMarcaProducto());
} else {
    echo -1;
}

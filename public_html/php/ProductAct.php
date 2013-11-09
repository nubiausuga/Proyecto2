<?php

include_once '../DAO/DAOs.php';
include '../Establecimientos/Producto.php';

$reg = new DAOs();

if (!empty($_POST['postid']) && !empty($_POST['postdesc']) &&
        !empty($_POST['postvalue']) && !empty($_POST['postbrand'])) {

    $id = (int) $_POST['postid'];
    $desc = $_POST['postdesc'];
    $value = (double) $_POST['postvalue'];
    $brand = $_POST['postbrand'];
    
    $resultCode = $reg->codVer($id);
    
    if($resultCode == 0){
        echo $reg->actualizarProducto($id, $desc, $value, $brand);
    }else{
        echo 1;
    }
    
    
} else {
    echo -1;
}
	

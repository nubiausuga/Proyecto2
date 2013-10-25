<?php

include_once '../DAO/DAOs.php';
include '../Establecimientos/Producto.php';

$reg = new DAOs();

	 $idProduct = $_POST['postid'];
	 $descriptionProduct = $_POST['postdescription'];
	 $valueProduct = $_POST['postvalue'];

	$newProduct = new Producto($idProduct, $descriptionProduct, $valueProduct);

	
	$reg->actualizarProducto($newProduct->getIdProducto(), 
               $newProduct->getDescProducto(), $newProduct->getPrecioProducto() );
			  
	
?>
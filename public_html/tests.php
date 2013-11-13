<?php

include_once 'DAO/DAOs.php';
include_once 'Usuarios/Usuario.php';
include_once 'Usuarios/Estudiante.php';
include_once 'Usuarios/Empleado.php';


$test = new DAOs();
/*
echo "balance actual: ";
echo $test->getBalance(201010013010);
echo "\n se modifica balance \n";
$test->modifyBalance(201010013010, 14500);
echo "\n obtiene nuevo balance\n";
echo $test->getBalance(201010013010);
$test->addBalance(201010013010, 20000);
echo "\n se agrego balance y se obtiene el mas actual: ";
echo $test->getBalance(201010013010);
 * 
 */

/*
echo $test->getEstadoCuenta(201010013010);

$test->cambiarEstadoCuenta(201010013010, "Activada");

echo "\n" . $test->getEstadoCuenta(201010013010);
*/

//testing again queries
//
//echo $test->validarUsuario(201010013010, 'Akuma');
//echo $test->getUserInfo(201010013010);
//echo $test->nuevoProducto(102, "bebida gaseosa", "4500", "Coca-Cola");
//echo $test->actualizarProducto(1, "Bebida Gaseosa Muy Rica", 4500, "Cola-Cola Company");
//echo $test->codVer(5);
//echo $test->addEmpleado(1017201436, "Developer", 1017201436, "EAFIT");

//crear tipo establecimiento
//$rand = rand(0,9999999999);   
//echo $test->addTipoEstablecimiento($rand, "Prueba de Tipo");

//echo $test->getDescTipoEstablecimiento(173891428);
//echo $test->getIdTipoEstablecimiento($test->getDescTipoEstablecimiento(173891428));
//echo $test->getUserInfo(201010013010);
//echo "\n Balance \n";
//echo $test->getBalance(201010013010);
//echo "\n Estado Cuenta \n";
//echo $test->getEstadoCuenta(1017201436);
//echo $test->getUserInfo(1017201436);
//echo $test->getEmplExtraInfo(1017201436);
//echo $test->addPropEstablecimiento(341930533, 1017201436);
//echo $test->getIdEstablecimiento(1017201436);
//echo $test->getEstablishmentName(1017201436);
//echo $test->getIdEstEmployee($test->getEstablishmentName(1017201436));
//$datetime = date("Y-m-d H:i:s"); 
//echo $datetime;
//echo $test->addFactura($datetime, 3000, 1, 3000, 0, 201010013010, 1231231231, 1017201436);
echo $test->facVerExist(1);
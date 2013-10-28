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


 
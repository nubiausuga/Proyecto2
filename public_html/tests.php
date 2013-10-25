<?php

include_once 'DAO/DAOs.php';
include_once 'Usuarios/Usuario.php';
include_once 'Usuarios/Estudiante.php';
include_once 'Usuarios/Empleado.php';

/*
$testIdVerifier = new Estudiante(201010013083, "Jason", "Musico", "password",
        "email@email.com", 1, "No importa");

echo $testIdVerifier->careerVer("201010013121");
*/
/*
$user = new Usuario(20143, "Jason", "Empleado", "soyEmpleado", "myEmail@eafit.edu.co", 2);
$testIdEmpl = new Empleado($user->getIdUsuario(), $user->getNombreUsuario(),
        $user->getApellidoUsuario(), $user->getPasswordUsuario(),
        $user->getEmailUsuario(), $user->getIdUsuario(), "EAFIT", "Gerente de Telematica");

$varVerifier = $testIdEmpl->idVerifier($user->getIdUsuario());

echo $varVerifier." ".  gettype($varVerifier)." ".gettype($user->getIdUsuario());
 * */
 
$dao = new DAOs();

echo $dao->actualizarProducto(45, "aaaaaaaa",8888888);
              // $newProduct->getDescProducto(), $newProduct->getPrecioProducto() );

//echo $dao->nuevoProducto(234,'mi segundo producto',50000);

//echo $dao->validarUsuario('Nubia', 'eafit2013');
//echo $dao->validarUserCod(200910013060, 'eafit2013');

//echo $dao->getUserType(200910013060)."\n";
//echo "\t".$dao->getUserType(1017201436);

?>
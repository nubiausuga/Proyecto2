<?php

include_once 'DAO/DAOs.php';
include_once 'Usuarios/Usuario.php';
include_once 'Usuarios/Estudiante.php';
include_once 'Usuarios/Empleado.php';

$dao = new DAOs;
$theTest = new Usuario(2, 'Natalia', 'Arroyave', 'narroya2', 'narroya2@eafit.edu.co');

$id = $theTest->getIdUsuario();
$nombre = $theTest->getNombreUsuario();
$apellido = $theTest->getApellidoUsuario();
$pass = $theTest->getPasswordUsuario();
$correo = $theTest->getEmailUsuario();

?>
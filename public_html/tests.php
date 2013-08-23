<?php

include_once 'DAO/DAOs.php';
include_once 'Usuarios/Usuario.php';
include_once 'Usuarios/Estudiante.php';
include_once 'Usuarios/Empleado.php';

$dao = new DAOs;
$theTest = new Estudiante(201010013010, 'Jason', 'Carcamo C', 'thisPass', 'jcarcam1@eafit.edu.co', 1, 'Ingenieria de Sistemas');

$id = $theTest->getIdUsuario();
$nombre = $theTest->getNombreUsuario();
$apellido = $theTest->getApellidoUsuario();
$pass = $theTest->getPasswordUsuario();
$correo = $theTest->getEmailUsuario();
$tipoDoc = $theTest->getTipoDocumentoUsuario();
$carrera = $theTest->getCarreraEstudiante();

 
 $dao->nuevoUsuario($id, $nombre, $apellido, $pass, $correo, $tipoDoc);
 $dao->addEstudiante($id, $carrera);
?>
<?php

include_once 'DAO/DAOs.php';
include_once 'Usuarios/Usuario.php';
include_once 'Usuarios/Estudiante.php';
include_once 'Usuarios/Empleado.php';

$dao = new DAOs;
/* $theTest = new Estudiante(201110012020, 'Natalia', 'Arroyave', 'thisPass', 'narroya2@eafit.edu.co', 1, 'Ingenieria de Diseño');

$id = $theTest->getIdUsuario();
$nombre = $theTest->getNombreUsuario();
$apellido = $theTest->getApellidoUsuario();
$pass = $theTest->getPasswordUsuario();
$correo = $theTest->getEmailUsuario();
$tipoDoc = $theTest->getTipoDocumentoUsuario();
$carrera = $theTest->getCarreraEstudiante();

 
 $dao->nuevoUsuario($id, $nombre, $apellido, $pass, $correo, $tipoDoc);
 $dao->addEstudiante($id, $carrera);
 * 
 */


?>
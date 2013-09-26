<?php

include_once 'DAO/DAOs.php';
include_once 'Usuarios/Usuario.php';
include_once 'Usuarios/Estudiante.php';
include_once 'Usuarios/Empleado.php';

//$dao = new DAOs;
$est = new Usuario(201010013010, 'Jason', 'Carcamo', 'thisPass', 'jcarcam1@gmail.com', 1);
$est2 = new Usuario(92040405307, 'Jason', 'Carcamo', 'thisPass', 'jcarcam1@gmail.com', 1);
$stringId = (string) $est->getIdUsuario();
$stringId2 = (string) $est2->getIdUsuario();

//echo $est->idVerifier($stringId);//echo "\n";
//
$est->careerVer($stringId);
//echo $est2->idVerifier($stringId2);
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
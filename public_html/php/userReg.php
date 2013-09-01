<?php

include_once '../DAO/DAOs.php';

$reg = new DAOs();

$docIdent = $_POST['postdoc'];
$name = $_POST['postuser'];
$lastname = $_POST['postlastname'];
$password = $_POST['postpass'];
$email = $_POST['postemail'];
$carrer = $_POST['postcareer'];

$reg->addEstudiante($docIdent, $carrer);
$reg->nuevoUsuario($docIdent, $name, $lastname, $password, $email, $docIdent);

?>

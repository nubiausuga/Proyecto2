<?php

include_once '../DAO/DAOs.php';

$reg = new DAOs();

if (!empty($_POST['postdoc']) && !empty($_POST['postuser']) &&
        !empty($_POST['postlastname']) && !empty($_POST['postpass']) &&
        !empty($_POST['postemail']) && !empty($_POST['postest']) &&
        !empty($_POST['postjob'])) {

    $docIdent = $_POST['postdoc'];
    $name = $_POST['postuser'];
    $lastname = $_POST['postlastname'];
    $password = $_POST['postpass'];
    $email = $_POST['postemail'];
    $establishmet = $_POST['postest'];
    $jobTitle = $_POST['postjob'];

    echo $reg->nuevoUsuario($docIdent, $name, $lastname, $password, $email, 2);
} $reg->addEmpleado($docIdent, $jobTitle, $establishmet);
?>

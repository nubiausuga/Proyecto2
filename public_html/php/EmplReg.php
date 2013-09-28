<?php

include_once '../DAO/DAOs.php';
include '../Usuarios/Usuario.php';
include '../Usuarios/Empleado.php';

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
    $establishment = $_POST['postest'];
    $jobTitle = $_POST['postjob'];

    $newUser = new Usuario($docIdent, $name, $lastname, $password, $email, 2);
    $newEmployee = new Empleado($docIdent, $name, $lastname, $password,
            $email, $docIdent, $establishment, $jobTitle);

    $varVerifier = $newEmployee->idVerifier($docIdent);
    if ($varVerifier == -1) {
        return -1;
    } else {
        $reg->nuevoUsuario($newUser->getIdUsuario(), 
                $newUser->getNombreUsuario(), $newUser->getApellidoUsuario(), 
                $newUser->getPasswordUsuario(), $newUser->getEmailUsuario(), 2);
        echo $reg->addEmpleado($newUser->getIdUsuario(),
                $newEmployee->getCargoEmpleado(),
                $newEmployee->getEstablecimientoEmpleado());
    }
}
?>

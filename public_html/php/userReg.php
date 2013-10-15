<?php

include_once '../DAO/DAOs.php';
include '../Usuarios/Usuario.php';
include '../Usuarios/Estudiante.php';

$reg = new DAOs();
//$newUser;
//$newStudent;

if (!empty($_POST['postdoc']) && !empty($_POST['postuser']) &&
        !empty($_POST['postlastname']) && !empty($_POST['postpass']) &&
        !empty($_POST['postemail']) && !empty($_POST['postcareer'])) {

    $docIdent = $_POST['postdoc'];
    $name = $_POST['postuser'];
    $lastname = $_POST['postlastname'];
    $password = $_POST['postpass'];
    $email = $_POST['postemail'];
    $carrer = $_POST['postcareer'];

    $newUser = new Usuario($docIdent, $name, $lastname, $password, $email, 1);
    $newStudent = new Estudiante($docIdent, $name, $lastname,
            $password, $email, 1, $carrer);

    $newStudent->idVerifier($docIdent);
}
if ($newStudent->getCarreraEstudiante() == -1) {
    echo -1;
} else {
    //Agregar nuevo usuario a la base de datos

    $reg->nuevoUsuario($newStudent->getIdUsuario(),
            $newStudent->getNombreUsuario(), $newStudent->getApellidoUsuario(),
            $newStudent->getPasswordUsuario(), $newStudent->getEmailUsuario(),
            $newStudent->getTipoDocumentoUsuario());

    echo $reg->addEstudiante($newUser->getIdUsuario(),
            $newStudent->getCarreraEstudiante());
}
?>

<?php

include_once '../DAO/DAOs.php';
include '../Usuarios/Usuario.php';
include '../Usuarios/Estudiante.php';
include '../Cuentas/Cuenta.php';

$reg = new DAOs();

if (!empty($_POST['postdoc']) && !empty($_POST['postuser']) &&
        !empty($_POST['postlastname']) && !empty($_POST['postpass']) &&
        !empty($_POST['postemail'])) {

    $docIdent = $_POST['postdoc'];
    $name = $_POST['postuser'];
    $lastname = $_POST['postlastname'];
    $password = $_POST['postpass'];
    $email = $_POST['postemail'];

    $newUser = new Usuario($docIdent, $name, $lastname, $password, $email, 1);
    $newStudent = new Estudiante($docIdent, $name, $lastname,
            $password, $email, 1, "No Importa");

    $newStudent->idVerifier($docIdent);
}
if ($newStudent->getCarreraEstudiante() == -1) {
    echo -1;
} else {
    
    //Agregar nuevo usuario
    $reg->nuevoUsuario($newStudent->getIdUsuario(),
            $newStudent->getNombreUsuario(), $newStudent->getApellidoUsuario(),
            $newStudent->getPasswordUsuario(), $newStudent->getEmailUsuario(),
            $newStudent->getTipoDocumentoUsuario());
    
    //crear una cuenta nueva en la base de datos con la info del nuevo user.
    $account = 
            new Cuenta($newStudent->getIdUsuario(),
                    $newStudent->getIdUsuario(), 0.0, 'Activada');
    
    $reg->crearCuenta($account->getIdCuenta(), 
            $account->getIdUsuarioCuenta(), 
            $account->getSaldoCuenta(), $account->getEstadoCuenta());
    
    //agregar el estudiante
    
    echo $reg->addEstudiante($newUser->getIdUsuario(),
            $newStudent->getCarreraEstudiante(),$newStudent->getIdUsuario());
}


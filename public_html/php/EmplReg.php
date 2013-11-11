<?php

include_once '../DAO/DAOs.php';
include '../Usuarios/Usuario.php';
include '../Usuarios/Empleado.php';
include '../Cuentas/Cuenta.php';

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
        //agregar un nuevo usuario
        $reg->nuevoUsuario($newUser->getIdUsuario(), 
                $newUser->getNombreUsuario(), $newUser->getApellidoUsuario(), 
                $newUser->getPasswordUsuario(), $newUser->getEmailUsuario(), 2);
        //crear una cuenta nueva
        
        $account = new Cuenta($newEmployee->getIdUsuario(),
                $newEmployee->getIdUsuario(), 0.0, 'Activada');
        
        $reg->crearCuenta($account->getIdCuenta(),
                $account->getIdUsuarioCuenta(),
                $account->getSaldoCuenta(), $account->getEstadoCuenta());
        
        //crear Empleado
        echo $reg->addEmpleado($newEmployee->getIdUsuario(),
                $newEmployee->getCargoEmpleado(),
                $newEmployee->getIdUsuario(),
                $newEmployee->getEstablecimientoEmpleado());
   }
}
?>

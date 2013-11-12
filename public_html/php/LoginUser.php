<?php

include_once '../DAO/DAOs.php';
include_once '../Usuarios/Usuario.php';

$login = new DAOs();
$access = false;

if (!empty($_POST['postname']) && !empty($_POST['postpass'])) {
    $user = $_POST['postname'];
    $pass = $_POST['postpass'];

    $userType = $login->getUserType($user);

    $valResult = $login->validarUserCod($user, $pass);

    if ($valResult == 0) {
        //$newUser = new Usuario($id, $name, $lastname, $pass, $mail, $type);
        session_start();
        $_SESSION['access'] = true;
        $_SESSION['user'] = $user;

        $userInfo = $login->userDecoder($user);
        if ($userType == 1) {
            echo 1;
        } else {
            echo 2;
        }
    } else {
        echo -1;
    }
}
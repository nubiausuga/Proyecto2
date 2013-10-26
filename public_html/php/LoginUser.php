<?php

include_once '../DAO/DAOs.php';
include_once '../Usuarios/Usuario.php';

$login = new DAOs();

if (!empty($_POST['postname']) && !empty($_POST['postpass'])) {
    $user = $_POST['postname'];
    $pass = $_POST['postpass'];

    $userType = $login->getUserType($user);

    $valResult = $login->validarUserCod($user, $pass);

    //TODO
    //$id = $userInfo->{'id_Doc_Identidad'};
    /*
      $name = $obj->{'Usr_Nombres'};
      $lastname = $obj->{'Usr_Apellidos'};
      //$pazz = $obj->{'Usr_Password'};
      $mail = $obj->{'Usr_Correo'};
      $type = $obj->{'Usr_Tipo_Documento'};
     * 
     */

    if ($valResult == 0) {
        //$newUser = new Usuario($id, $name, $lastname, $pass, $mail, $type);
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
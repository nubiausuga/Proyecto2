<?php

include '../DAO/DAOs.php';

$desactivar = new DAOs();

if (!empty($_POST['postId'])) {

    $user = $_POST['postId'];

    $getEstado = $desactivar->getEstadoCuenta($user);

    $estado = "Problem";

    switch ($getEstado) {

        case 'Bloqueada':
            $estado = "Activada";
            break;
        case 'Activada':
            $estado = "Bloqueada";
            break;
        default:
            $estado = "Problem";
            break;
    }

    return $desactivar->cambiarEstadoCuenta($user, $estado);
}
<?php

include_once '../DAO/DAOs.php';

$login = new DAOs();


if(!empty($_POST['postname']) && !empty($_POST['postpass'])){
    $user = $_POST['postname'];
    $pass = $_POST['postpass'];
    echo $login->validarUsuario($user, $pass);
}

?>

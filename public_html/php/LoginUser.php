<?php

include '../DAO/DAOs.php';

$login = new DAOs();
$login->instance();

$user = $_POST['postname'];
$pass = $_POST['postpass'];

echo $login->validarUsuario($user, $pass);
?>

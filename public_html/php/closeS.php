<?php

session_start();
include '../DAO/DAOs.php';

$dao = new DAOs();

$_SESSION['access'] = false;
$estado = $_SESSION['access'];
session_destroy();

echo $estado;



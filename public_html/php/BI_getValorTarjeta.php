<?php

include '../DAO/DAOs.php';

$daos = new DAOs();

session_start();
$admin = $_SESSION['user'];

//get id Establecimiento
$idEstablecimiento = $daos->getIdEstablecimiento($admin);

//get query
echo $daos->getValorVentaTarjeta($idEstablecimiento);


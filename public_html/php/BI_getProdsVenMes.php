<?php

include '../DAO/DAOs.php';

$daos = new DAOs();

session_start();
$admin = $_SESSION['user'];

//get establecimiento al que pertenece
$idEstablecimiento = $daos->getIdEstablecimiento($admin);

if (!empty($_POST['postini']) && !empty($_POST['postfin'])) {

    $fechaIni = $_POST['postini'];
    $fechaFin = $_POST['postfin'];
    
    echo $daos->getProdsVenMes($fechaIni, $fechaFin);
    
} else {
    return -1;
}
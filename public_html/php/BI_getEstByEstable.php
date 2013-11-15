<?php

include '../DAO/DAOs.php';

$daos = new DAOs();

session_start();
$admin = $_SESSION['user'];

//get establecimiento al que pertenece
$idEstablecimiento = $daos->getIdEstablecimiento($admin);

//query bi
echo $daos->getEstudiantesByEstablecimiento($idEstablecimiento);
//error en query
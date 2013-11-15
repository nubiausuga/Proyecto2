<?php

include '../DAO/DAOs.php';

$daos = new DAOs();

session_start();
$admin = $_SESSION['user'];

//get establecimiento al que pertenece
$idEstablecimiento = $daos->getIdEstablecimiento($admin);

if(!empty($_POST['postidEst'])){
    
    $idEstudiante = $_POST['postidEst'];
    
    echo $daos->getComprasEstudiantes($idEstudiante);
    
}else{
    return -1;
}
    
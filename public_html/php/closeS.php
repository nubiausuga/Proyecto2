<?php

include '../DAO/DAOs.php';

$dao = new DAOs();

session_destroy();
$estado = $_SESSION['access'];

if(!$estado){
    echo 0;
}else{
    
    
}



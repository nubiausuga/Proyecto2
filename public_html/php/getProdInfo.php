<?php

include '../DAO/DAOs.php';

$dao = new DAOs();

if (!empty($_POST['postcode'])){
    
    $code = $_POST['postcode'];
    
    $jsonArr = $dao->getProdInfo($code);
    
    echo $jsonArr;
}
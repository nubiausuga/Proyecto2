<?php

include_once '../DAO/DAOs.php';
include '../Establecimientos/Establecimiento.php';

$reg = new DAOs();

if (!empty($_POST['postnit']) && !empty($_POST['postname']) &&
        !empty($_POST['posttype']) && !empty($_POST['postresponsible']) &&
        !empty($_POST['postidresponsible'])){
    
    $nit = $_POST['postnit'];
    $estName = $_POST['postname'];
    $estType = $_POST['posttype'];
    $estRespo = $_POST['postresponsible'];
    $estIDRes = $_POST['postidresponsible'];
    
    $establecimiento =
            new Establecimiento($nit, $estName, $estRespo, $estType, $estIDRes);
    
    $resultStr = $establecimiento->convertNit($nit);
    
    //crear tipo establecimiento
    $rand = rand(0,9999999999);
    $reg->addTipoEstablecimiento($rand, $estType);
    
    //agregar nuevo establecimiento
    echo ($reg->addEstablecimiento($resultStr, $establecimiento->getEstNombre(),
            $establecimiento->getIdResponsable(),
            $establecimiento->getIdEstablecimiento(),
            $reg->getIdTipoEstablecimiento($estType)));
    
}else{
    //An empty field double verification
    echo -1;
}


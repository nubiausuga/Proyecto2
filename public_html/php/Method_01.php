<?php

include '../DAO/DAOs.php';

$daos = new DAOs();

if (!empty($_POST['postcode']) && !empty($_POST['postestab'])
        && !empty($_POST['postdateini']) && !empty($_POST['postdateend'])) {

    $code = $_POST['postcode'];
    $estab = $_POST['postestab'];
    $dateIni = $_POST['postdateini'];
    $dateEnd = $_POST['postdateend'];
    
    //continua
    
} else {
    echo -1;
}


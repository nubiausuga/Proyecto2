<?php

include '../DAO/DAOs.php';

$regCarnet = new DAOs();

echo $regCarnet->readCarnet();
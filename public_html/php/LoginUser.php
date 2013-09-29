<?php

include_once '../DAO/DAOs.php';

$login = new DAOs();


if (!empty($_POST['postname']) && !empty($_POST['postpass'])) {
    $user = $_POST['postname'];
    $pass = $_POST['postpass'];

    $userType = $login->getUserType($user);

    $valResult = $login->validarUserCod($user, $pass);

    if ($valResult == 0) {
        if ($userType == 1) {
            echo 1;
        } else {
            echo 2;
        }
    } else {
        echo -1;
    }
}
?>

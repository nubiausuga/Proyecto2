<?php

include_once 'DAO/DAOs.php';
include_once 'Usuarios/Usuario.php';
include_once 'Usuarios/Estudiante.php';
include_once 'Usuarios/Empleado.php';


$test = new DAOs();

//$info = $test->getUserInfo('1017201436');

 //echo $unobj = $test->userDecoder($info);
 /*
 $id = $unobj->{'id_Doc_Identidad'};
 $name = $unobj->{'Usr_Nombres'};
 $lastname = $unobj->{'Usr_Apellidos'};
 $pass = $unobj->{'Usr_Password'};
 $mail = $unobj->{'Usr_Correo'};
 $type = $unobj->{'Usr_Tipo_Documento'};
 
 echo ($id." ".$name." ".$lastname." ".$pass." ".$mail." ".$type);
 */
 
$test->crearCuenta(1017201436, 1017201436, 0, 'Activada');
 
?>
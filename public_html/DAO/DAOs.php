<?php

include 'DatabaseConc.php';

class DAOs {

    private $datab;
    private $connector;
    public static $Dao_user_info;

    //-------Tipo de Documento-----
    // 1 - CarnetEstudiante
    // 2 - Cedula Ciudadana
    // 3 - Cedula Extrangera
    // 4 - Tarjeta de Identidad
    // 5 - Otros

    public function __construct() {
        $this->datab = DatabaseConc::instance();
        $this->connector = $this->datab->getConnection();
    }

    public function instance() {
        if (!isset(self::$Dao_user_info)) {
            self::$Dao_user_info = new DAOs();
            return self::$Dao_user_info;
        } else {
            return self::$Dao_user_info;
        }
    }

    function deleteTable($nombreTbl) {
        //Eliminar una tabla en la base de datos si existe.
        if (empty($nombreTbl)) {
            return false;
        }

        $query = "DROP TABLE IF EXISTS `$nombreTbl`";
        $success1 = mysql_query($query) or die(mysql_error());

        if ($success1) {
            echo("La Tabla $nombreTbl ha sido eliminada.");
        } else {
            echo("Erro al eliminar la tabla $nombreTbl .");
        }
    }

    function removeGen($tablaX, $campoY, $elementoZ) {

        if (empty($tablaX) or empty($campoY) or empty($elementoZ)) {
            return false;
        }
        //Eliminador generico para eliminar la fila de elemento
        //dado los parámetros. 
        //(eliminar de tabla X, cuyo campo Y es = a elementoZ
        $sql_delete = "DELETE FROM $tablaX WHERE $campoY ='$elementoZ'";
        $exito = mysql_query($sql_delete) or die(mysql_error());
        //verificar que fue correcta la operación.
        if ($exito) {
            echo "operación de eliminación realizada exitosamente";
        } else {
            echo "Operación de eliminación fracaso";
        }
    }

    function nuevoUsuario($id_Usuario, $usr_nombre, 
            $usr_apellidos, $usr_password, $usr_correo, $usr_tipoDoc) {

        if (empty($id_Usuario) or empty($usr_nombre) or empty($usr_apellidos) or
                empty($usr_password) or empty($usr_correo) or empty($usr_tipoDoc)) {
            return false;
        }

        $enc = md5($usr_password);
        $in = "INSERT INTO `usuario`(id_Doc_Identidad,Usr_Nombres,Usr_Apellidos,
                             Usr_Password,Usr_Correo,Usr_Tipo_Documento)
                    VALUES('$id_Usuario','$usr_nombre','$usr_apellidos','$enc',
                        '$usr_correo','$usr_tipoDoc')";

        $success = mysql_query($in) or die(mysql_error());

        if ($success) {
            return 0; //successful
        } else {
            return 1; //failed
        }
    }
    
   function getUserInfo($code) {
        $query = "SELECT * FROM `usuario` "
                . "WHERE `id_Doc_Identidad`='$code' ";
        $success = mysql_query($query) or die(mysql_error());

        if ($success) {
            $dbarray = mysql_fetch_array($success);
            return json_encode($dbarray);
        } else {
            return -1;
        }
    }
    
    function userDecoder($jsonObj) {
        $obj = json_decode($jsonObj);
        return $obj;
    }

    function nuevoProducto($idProduct, $descriptionProduct, $valueProduct) {

        if (empty($idProduct) or empty($descriptionProduct)
                or empty($valueProduct)) {
            return false;
        }
        $in = "INSERT INTO `producto`(id_Producto,Prod_Descripcion,Prod_Precio)
                    VALUES('$idProduct','$descriptionProduct','$valueProduct')";

        $success = mysql_query($in) or die(mysql_error());

        if ($success) {
            return 0; //successful
        } else {
            return 1; //failed
        }
    }

    function actualizarProducto($idProduct, $descriptionProduct, $valueProduct) {

        if (empty($idProduct) or
                empty($descriptionProduct) or
                empty($valueProduct)) {
            return false;
        }

        $in = "UPDATE  `producto`  SET producto.Prod_Descripcion = "
                . "'$descriptionProduct',producto.Prod_Precio = '$valueProduct'	
		WHERE producto.id_Producto = '$idProduct'";

        $success = mysql_query($in) or die(mysql_error());

        if ($success) {
            return 0; //successful
        } else {
            return 1; //failed
        }
    }

    function addEstudiante($idEstudiante, $carreraEstudiante) {
        
        if (empty($idEstudiante) or empty($carreraEstudiante)) {
            return false;
        }
        
        $in_estudiante = "INSERT INTO `estudiante`(Est_id_Doc_Identidad,Str_Carrera)
                        VALUES('$idEstudiante','$carreraEstudiante')";
        $success = mysql_query($in_estudiante) or die(mysql_error());
        if($success){
           return 0;
        }else{
           return 1;
        }
            
    }
    
    function addEmpleado($idEmpleado, $cargoEmpleado, $establecimientoEmpleado) {
       
        $in_empleado = "INSERT INTO `empleado`(id_Doc_Identidad,Str_Cargo,
            Str_Establecimiento)
            VALUES ('$idEmpleado','$cargoEmpleado','$establecimientoEmpleado')";
        $success = mysql_query($in_empleado) or die(mysql_error());
        if ($success) {
            return 0;
        } else {
            return 1;
        }
    }

    function addMovimiento($idMovimiento, $idEstablecimiento, //pago de factura en establecimiento
            $descMovimiento, $fechaMovimiento, $horaMovimiento,
            $valorMovimiento, $idCuentaMovimiento) {

        $in_movimiento = "INSERT INTO `movimiento`(id_Movimiento,
           id_Establecimiento,Mov_Descripcion,Mov_Fecha,Mov_Hora,Mov_Valor,
           id_Cuenta)
           VALUES('$idMovimiento','$idEstablecimiento','$descMovimiento',
               '$fechaMovimiento','$horaMovimiento',
                   '$valorMovimiento','$idCuentaMovimiento')";
        $success = mysql_query($in_movimiento) or die(mysql_error());
        if ($success) {
            echo "Exito al agregar movimiento nuevo.";
        } else {
            echo "Error al agregar el movimiento nuevo.";
        }
    }

    function addProducto($idProducto, $descProducto, 
            $precioProducto, $idEstablecimientoProducto) {

        $in_producto = "INSERT INTO `producto`(id_Producto,Prod_Descripcion,
            Prod_Precio,Prod_id_Establecimiento)
            VALUES ('$idProducto','$descProducto','$precioProducto',
                '$idEstablecimientoProducto')";
        $success = mysql_query($in_producto) or die(mysql_error());
        if ($success) {
            echo "El producto ha sido agregado exitosamente";
        } else {
            echo "Error al agregar el producto nuevo!.";
        }
    }
    //funcion para verificar si el usuario y contraseña son correctos
    function validarUsuario($usuario, $password) {
        $usuario = str_replace("'", "''", $usuario);
        $password = md5($password);
        $verify = "SELECT Usr_Password FROM `usuario`
                        WHERE Usr_Nombres = '$usuario'";
        $success = mysql_query($verify) or die(mysql_error());
        if (!$success || (mysql_num_rows($success) < 1)) {
            return -1; //failed to verify
        }
        $dbArray = mysql_fetch_array($success);
        if ($password == $dbArray['Usr_Password']) {
            return 0; //yep user exists.
        } else {
            return -1; //falla;
        }
    }

    function validarUserCod($user,$pass){
        $user = str_replace("'", "''", $user);
        $pass = md5($pass);
        
        $verification = "SELECT Usr_Password FROM `usuario`
                            WHERE id_Doc_identidad = '$user'";
        $success = mysql_query($verification) or die(mysql_error());
        if(!$success || (mysql_num_rows($success)<1)){
            return -1;
        }
        
        $dbArray = mysql_fetch_array($success);
        
        if($pass == $dbArray['Usr_Password']){
            return 0;
        }else{
            return -1;
        }
    }
    
    function getUserType($id){
        
        $getUT = "SELECT Usr_Tipo_Documento FROM `usuario`
                    WHERE id_Doc_Identidad = '$id'";
        $success = mysql_query($getUT) or die(mysql_error());
        
        $dbArray = mysql_fetch_array($success);
        
        if($success){
            return $dbArray['Usr_Tipo_Documento'];
        }else{
            return -1;
        }
    }
    
    function addEstablecimiento($idEstablecimiento, $nombreEstablecimiento,
            $responsableEstablecimiento, $tipoEstablecimiento){
        
        $in_establecimiento = "INSERT INTO `establecimiento`(id_Establecimiento,
            Est_Nombre, Est_Responsable, Est_Tipo_Establecimiento)
            VALUES('$idEstablecimiento','$nombreEstablecimiento',
                '$responsableEstablecimiento','$tipoEstablecimiento')";
        $success = mysql_query($in_establecimiento) or die(mysql_error());
        if($success){
            echo "Se ha agregado satisfactoriamente el establecimiento.";
        }else{
            echo "Error al agregar el establecimiento";
        }
    }
    
    function addTipoEstablecimiento($id_Tipo_Establecimiento, $TEst_Descripcion) {

        $in_tipoEstablecimiento =
                "INSERT INTO `tipo_establecimiento`
                    (id_Tipo_Establecimiento,TEst_Descripcion)
                    VALUES('$id_Tipo_Establecimiento','$TEst_Descripcion')";
        $success = mysql_query($in_tipoEstablecimiento) or die(mysql_error());
        if ($success) {
            return 0;
        } else {
            return -1;
        }
    }
    
    function editProductPrice($id_product){
        //TODO
        return $id_product;
    }
    
    function deleteProduct($id_product){
        //TODO
        return $id_product;
    }
 
}
?>
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
    
    //Eliminar una tabla en la base de datos si existe
    function deleteTable($nombreTbl) {
       
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
    
     //Eliminador generico para eliminar la fila de elemento
        //dado los parámetros. 
        //(eliminar de tabla X, cuyo campo Y es = a elementoZ
    function removeGen($tablaX, $campoY, $elementoZ) {

        if (empty($tablaX) or empty($campoY) or empty($elementoZ)) {
            return false;
        }
       
        $sql_delete = "DELETE FROM $tablaX WHERE $campoY ='$elementoZ'";
        $exito = mysql_query($sql_delete) or die(mysql_error());
        //verificar que fue correcta la operación.
        if ($exito) {
            echo "operación de eliminación realizada exitosamente";
        } else {
            echo "Operación de eliminación fracaso";
        }
    }
    
    //agregar un nuevo usuario a la base de datos con todos los campos.
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
    
   //obtiene la información de los usuarios dado el código identificador único.
   function getUserInfo($code) {
        $query = "SELECT * "
                . "FROM `usuario`"
                . "WHERE id_Doc_Identidad ='$code'";
        $success = mysql_query($query) or die(mysql_error());

        if ($success) {

            $dbarray = mysql_fetch_array($success);
            return json_encode($dbarray);
        } else {
            return -1;
        }
    }

    function getEmplExtraInfo($code){
        
        $empl = "SELECT * FROM `empleado`"
                . "WHERE `id_Doc_Identidad`='$code'";
        $success = mysql_query($empl) or die(mysql_error());
        
        if($success){
            $dbarray = mysql_fetch_array($success);
            return json_encode($dbarray);
        }else{
            return -1;
        }
    }
    
    //decodifica un objeto Json para uso exterior.
    function userDecoder($jsonObj) {
        $obj = json_decode($jsonObj);
        return $obj;
    }
    
    //agrega un nuevo producto a la base de datos dado todos sus campos.
    function nuevoProducto($idProduct, $descriptionProduct, $valueProduct,$prodBrand) {

        if (empty($idProduct) or empty($descriptionProduct)
                or empty($valueProduct)) {
            return 1;
        }
        $in = "INSERT INTO `producto`(id_Producto,Prod_Descripcion,Prod_ValorUnitario,Prod_Marca)
                    VALUES('$idProduct','$descriptionProduct','$valueProduct','$prodBrand')";

        $success = mysql_query($in) or die(mysql_error());

        if ($success) {
            return 0; //successful
        } else {
            return 1; //failed
        }
    }
    
    //actualiza el precio de un producto
    function actualizarProducto($idProduct, $descriptionProduct, $valueProduct,$brand) {

        if (empty($idProduct) or
                empty($descriptionProduct) or
                empty($valueProduct) or
                empty($brand)){
            return -1;
        }

        $in = "UPDATE  `producto`  SET producto.Prod_Descripcion = "
                . "'$descriptionProduct',producto.Prod_ValorUnitario = '$valueProduct',
                    producto.Prod_Marca = '$brand'                    
		WHERE producto.id_Producto = '$idProduct'";

        $success = mysql_query($in) or die(mysql_error());

        if ($success) {
            return 0; //successful
        } else {
            return 1; //failed
        }
    }
    
    //verificar existencia de código de producto
    function codVer($cod){
        
        $quer = "SELECT id_Producto "
                . "FROM `producto` WHERE id_Producto ='$cod'";
        
        $exists = mysql_query($quer) or die(mysql_error());
        
        $arr = mysql_fetch_array($exists);
        
        if($arr[0] !== null){
            return 0;
        }else{
            return -1;
        }
    }
       
    //agrega un usuario como estudiante a la base de datos
    function addEstudiante($idEstudiante, $carreraEstudiante,$idDocIdent) {
        
        if (empty($idEstudiante) or empty($carreraEstudiante)) {
            return false;
        }
        
        $in_estudiante =
                "INSERT INTO `estudiante`(id_Doc_Identidad,Str_Carrera,
                    Usuario_id_Doc_Identidad)
                        VALUES('$idEstudiante',"
                . "'$carreraEstudiante','$idDocIdent')";
        $success = mysql_query($in_estudiante) or die(mysql_error());
        if($success){
           return 0;
        }else{
           return 1;
        }
            
    }
    
    //agrega un usuario como empleado
    function addEmpleado($idEmpleado, $cargoEmpleado,$userDoc,
            $establecimientoEmpleado) {
       
        $in_empleado = "INSERT INTO `empleado`(id_Doc_Identidad,Str_Cargo,
            Usuario_id_Doc_Identidad,empl_Establecimiento)
            VALUES ('$idEmpleado','$cargoEmpleado','$userDoc',"
                . "'$establecimientoEmpleado')";
        
        $success = mysql_query($in_empleado) or die(mysql_error());
        if ($success) {
            return 0;
        } else {
            return 1;
        }
    }
    
    //agrega un nuevo movimiento de cuenta a la base de datos.
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
    
    //agregar un nuevo producto a la base de datos.
    // (Repetido) TODO
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
        $success = mysqli_query($local,$verify) or die(mysqli_error($local));
        if (!$success || (mysqli_num_rows($success) < 1)) {
            return -1; //failed to verify
        }
        $dbArray = mysqli_fetch_array($success);
        if ($password == $dbArray['Usr_Password']) {
            return 0; //yep user exists.
        } else {
            return -1; //falla;
        }
    }
    
    //valida que el codigo y contraseña coiciden en la base de datos.
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
    
    //obtiene el tipo del usuario: 1 para estudiantes, 2 empleados.
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
    
    //agrega un nuevo establecimiento a la base de datos.
    function addEstablecimiento($idEstablecimiento, $nombreEstablecimiento,
            $nit, $tipoEstablecimiento) {

        $in_establecimiento = "INSERT INTO `establecimiento`(id_Establecimiento,
            Est_Nombre, Tipo_Establecimiento_id_Tipo_Establecimiento1,
            Nit_Establecimiento)
            VALUES('$idEstablecimiento','$nombreEstablecimiento',"
                . "'$tipoEstablecimiento','$nit')";

        $success = mysql_query($in_establecimiento) or die(mysql_error());
        if ($success) {
            //registrado satisfactoriamente
            return 0;
        } else {
            //error al registrar establecimiento
            return -1;
        }
    }

    //se agrega un nuevo tipo de establecimiento a la base de datos
    function addTipoEstablecimiento($id_Tipo_Establecimiento,
            $TEst_Descripcion) {

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
    
    
    function getDescTipoEstablecimiento($idTipo){
        
        $in = "SELECT `TEst_Descripcion`"
                . "FROM `tipo_establecimiento`"
                . " WHERE id_Tipo_Establecimiento = '$idTipo'";
        
        $get = mysql_query($in) or die(mysql_error());
        
        
        if($get){
            $fetch = mysql_fetch_array($get);
            return $fetch['TEst_Descripcion'];
        }else{
            return -1;
        }
    }
    
    //get id del establecimiento dado el dueño del establecimiento
    function getIdEstablecimiento($idOwner) {

        $getID = "SELECT `Establecimiento_id_Establecimiento` "
                . "FROM `establecimiento_has_propietario`"
                . "WHERE `Propietario_id_Doc_Identidad`='$idOwner'";

        $success = mysql_query($getID) or die(mysql_error());

        if ($success) {
            $fArr = mysql_fetch_array($success);
            return $fArr['Establecimiento_id_Establecimiento'];
        } else {
            return -1;
        }
    }
    
    //get nombre de establecimiento vinculado del empleado actual
    function getEstablishmentName($idEmployee) {

        $nombreEst = "SELECT `empl_Establecimiento` "
                . "FROM `empleado` "
                . "WHERE `id_Doc_Identidad`='$idEmployee'";

        $success = mysql_query($nombreEst) or die(mysql_error());

        if ($success) {
            $fArr = mysql_fetch_array($success);
            return $fArr['empl_Establecimiento'];
        } else {
            return -1;
        }
    }

    //get id del establecimiento dado nombre del establecimiento y su trabajador
    //actual del contexto.
    function getIdEstEmployee($estName) {

        $getId = "SELECT `id_Establecimiento` "
                . "FROM `establecimiento`"
                . "WHERE `Est_Nombre`='$estName'";

        $success = mysql_query($getId) or die(mysql_error());

        if ($success) {
            $fArr = mysql_fetch_array($success);
            return $fArr['id_Establecimiento'];
        } else {
            return -1;
        }
    }

    function getIdTipoEstablecimiento($desc){
        
        $in = "SELECT `id_Tipo_Establecimiento`"
                . "FROM `tipo_establecimiento`"
                . " WHERE TEst_Descripcion = '$desc'";
        
        $getId = mysql_query($in) or die(mysql_error());
        
        if($getId){
            $fetch = mysql_fetch_array($getId);
            return $fetch['id_Tipo_Establecimiento'];
        }else{
            return -1;
        }
       
    }
    
    //crea una cuenta nueva en la base de datos dado un id de usuario y cuenta único
   function crearCuenta($idCuenta, $idUsuario,$saldo,$estado){
        $cuentaNueva = "Insert INTO `cuenta`"
                . "(id_Cuenta, Cuen_Saldo, Cuen_Estado, Usuario_id_Doc_Identidad)"
                . "VALUES('$idCuenta','$saldo','$estado','$idUsuario')";
        
        $success = mysql_query($cuentaNueva) or die(mysql_error());
        
        if($success){
            return 0;
        }else{
            return -1;
        }
    }
     
    //eliminar un producto de la base de datos
    function deleteProduct($id_product){
        //TODO
        return $id_product;
    }
    
    //obtener el balance de una cuenta dado un id de usuario
    // TODO (PESIMA SEGURIDAD)
    function getBalanceIdUsuario($id) {
        $balance = "SELECT `Cuen_Saldo`"
                . "FROM `cuenta` WHERE id_usuario='$id'";
        $success = mysql_query($balance) or die(mysql_error());

        $dbArr = mysql_fetch_array($success);

        if ($success) {
            return $dbArr[0];
        } else {
            return -1;
        }
    }
    
    //obtener el balance dado el id de la cuenta
       function getBalance($idCuenta) {
        $balance = "SELECT `Cuen_Saldo`"
                . "FROM `cuenta` WHERE id_Cuenta='$idCuenta'";
        $success = mysql_query($balance) or die(mysql_error());

        $dbArr = mysql_fetch_array($success);

        if ($success) {
            return $dbArr[0];
        } else {
            return -1;
        }
    }
    
    //modificar el balance dato un id
    // TODO (PESIMA SEGURIDAD)
    function modifyBalance($id, $newBalance) {

        $modBalance = "UPDATE `cuenta` "
                . "SET Cuen_saldo = '$newBalance' WHERE id_Cuenta='$id'";
        $success = mysql_query($modBalance) or die(mysql_error());

        if ($success) {
            return 0;
        } else {
            return -1;
        }
    }
    
    //agregar dinero al balance actual
    function addBalance($id,$plusAmount){
        
       $getAmount = $this->getBalance($id);
       
       $newAmount = $getAmount + $plusAmount;
       
       $addAmount = "UPDATE `cuenta` SET Cuen_saldo ='$newAmount'"
               . "WHERE id_Cuenta='$id'";
       
       $success = mysql_query($addAmount) or die(mysql_error());
       
       if($success){
           return 0;
       }else{
           return -1;
       }
    }
    
    //para cambio de contraseña
    function changePassword($oldPassword){
        //TODO
    }
    
    //obtener el estado de la cuenta
    function getEstadoCuenta($id){
        
        $getEstado = "SELECT Cuen_Estado FROM `cuenta`
                    WHERE id_Cuenta='$id'";
        $result = mysql_query($getEstado) or die(mysql_error());
        $arr = mysql_fetch_array($result);
        
        if($result){
            return $arr['Cuen_Estado'];
        }else{
            return -1;
        }
    }
    
    //cambiar estado de cuenta
   function cambiarEstadoCuenta($id,$newEstado){
       
       $changeS = "UPDATE `cuenta` SET Cuen_Estado='$newEstado'"
               . "WHERE Id_usuario='$id'";
       $result = mysql_query($changeS) or die(mysql_error());
       
       if($result){
           return 0; //no problem.
       }else{
           return -1; //failed to change.
       }
   }   
   
   //cambiar cuenta dado id de la cuenta y valor del estado nuevo
    function cambiarEC($idcuenta,$valorEstado){
       
        $newEstado = "-1";
        
        switch ($valorEstado){
            case 0:
                $newEstado = "Desactivada";
                break;
            case 1:
                $newEstado = "Activada";
                break;
            case 2:
                $newEstado = "Bloqueada";
                break;
            default:
                $newEstado = "Problema";
                break;
        } 
        
       $changeS = "UPDATE `cuenta` SET Cuen_Estado='$newEstado'"
               . "WHERE Id_Cuenta='$idcuenta'";
       $result = mysql_query($changeS) or die(mysql_error());
       
       if($result){
           return 0; //no problem.
       }else{
           return -1; //failed to change.
       }
   }   
   
   function getProdInfo($code) {
        $query = "SELECT * FROM `producto` "
                . "WHERE `id_Producto`='$code'";
        $success = mysql_query($query) or die(mysql_error());

        $dbarray = mysql_fetch_array($success);
        if ($success) {
            return json_encode($dbarray);
        } else {
            return -1;
        }
    }
    
  //agregar propietario de establecimiento has propietario
  function addPropEstablecimiento($idEsta, $idOwner) {

        $regProp = "INSERT INTO"
                . " `establecimiento_has_propietario`"
                . "(Establecimiento_id_Establecimiento,Propietario_id_Doc_Identidad)"
                . "VALUES('$idEsta','$idOwner')";

        $success = mysql_query($regProp) or die(mysql_error());

        if ($success) {
            return 0;
        } else {
            return -1;
        }
    }
  
  //agregar propietario de establecimiento
  function addPropietario($idPropietario, $nombrePropietario, $usuarioIdProp) {

        $regPropietario = "INSERT INTO `propietario`"
                . "(id_Doc_Identidad,Pro_Nombre,Usuario_id_Doc_Identidad)"
                . "VALUES ('$idPropietario','$nombrePropietario','$usuarioIdProp')";
        $success = mysql_query($regPropietario) or die(mysql_error());
        if ($success) {
            return 0;
        } else {
            return -1;
        }
    }
    
  
    function addFactura($fac_Fecha, $fac_Total, $fac_EstadoFactura,
            $fac_ValorCarnet, $fac_ValorEfectivo, $idUsuario,
            $idEstablecimiento, $currentEmployee) {

        $addDate = "INSERT INTO `factura`(Fac_Fecha, Fac_Total,"
                . " Fac_EstadoFactura, Fact_ValorCarnet, Fact_ValorEfectivo,"
                . " Usuario_id_Doc_identidad1, Establecimiento_id_Establecimiento,"
                . " Empleado_id_Doc_Identidad)"
                . "VALUES('$fac_Fecha','$fac_Total','$fac_EstadoFactura',"
                . "'$fac_ValorCarnet','$fac_ValorEfectivo','$idUsuario',"
                . "'$idEstablecimiento','$currentEmployee')";

        $success = mysql_query($addDate) or die(mysql_error());

        if ($success) {
            return 0;
        } else {
            return -1;
        }
    }
    
    //verificar que ya existe en la base de datos un id Factura
    function facVerExist($idFac) {

        $idFacVer = "SELECT `idFactura`"
                . "FROM `factura`"
                . "WHERE `idFactura`='$idFac'";

        $querIt = mysql_query($idFacVer) or die(mysql_error());

        $fArr = mysql_fetch_array($querIt);
        if ($fArr == null) {
            //exito no existe
            return 0;
        } else {
            //existe factura
            return -1;
        }
    }
    
    function getFacId($dateTime) {

        $getFacId = "SELECT `idFactura`"
                . "FROM `factura`"
                . "WHERE `Fac_Fecha`='$dateTime' ";
        $success = mysql_query($getFacId) or die(mysql_error());

        if ($success) {
            $fArr = mysql_fetch_array($success);
            return $fArr['idFactura'];
        } else {
            return -1;
        }
    }
    
    function addToHasProducto($idFactura, $idProducto) {

        $add = "INSERT INTO `factura_has_producto`(Factura_idFactura,Producto_id_Producto)"
                . "VALUES('$idFactura','$idProducto')";
        $success = mysql_query($add) or die(mysql_error());

        if ($success) {
            return 0;
        } else {
            return -1;
        }
    }
    
    
    
    
    function getIdProdByName($prodName) {

        $getId = "SELECT `id_Producto` "
                . "FROM `producto`"
                . "WHERE `Prod_Descripcion`='$prodName'";

        $success = mysql_query($getId) or die(mysql_error());

        if ($success) {
            $fArr = mysql_fetch_array($success);
            return $fArr['id_Producto'];
        } else {
            return -1;
        }
    }
    
    function readCarnet() {
        $getCarnet = "SELECT `Android_Codigo` "
                . "FROM `android`"
                . "WHERE `idAndroid`= 1 ";
        $success = mysql_query($getCarnet) or die(mysql_error());
        if ($success) {
            $fArr = mysql_fetch_array($success);
            return $fArr['Android_Codigo'];
        } else {
            return -1;
        }
    }
    
    //---"BI" Queries ---
    //
    //mostrar las facturas entre fechas 
    function getFacturasByFecha($idEstablecimiento, $ini, $fin) {

        $query = "SELECT `idFactura`, `Fac_Fecha`, `Fac_Total`"
                . "FROM `factura`"
                . "WHERE Establecimiento_id_Establecimiento ='$idEstablecimiento' "
                . "&& Fac_Fecha > '$ini' && Fac_Fecha < '$fin'";

        $sucess = mysql_query($query) or die(mysql_error());

        if ($sucess) {
            $json = [];
            $count = 0;
            while ($row = mysql_fetch_array($sucess)) {
                $json[$count] = $row['idFactura'];
                $json[$count + 1] = $row['Fac_Fecha'];
                $json[$count + 2] = $row['Fac_Total'];
                $count+=3;
            }
            return json_encode($json);
        } else {
            return -1;
        }
    }

    // mostrar los estudiantes que compraron productos en un establecimiento
    function getEstudiantesByEstablecimiento($idEstablecimiento) {

        $getStudent = "SELECT id_Doc_Identidad, Usr_Correo, Usr_Nombres "
                . "FROM `usuario` WHERE(
                    SELECT DISTINCT (Usuario_id_Doc_Identidad1)
                        FROM `factura` 
                        WHERE Establecimiento_id_Establecimiento = '$idEstablecimiento')";

        $success = mysql_query($getStudent) or die(mysql_error());

        if ($success) {
            $arr = [];
            $count = 0;

            while ($row = mysql_fetch_row($success)) {
                $arr[$count] = $row;
                $count++;
            }

            return json_encode($arr);
        } else {
            return -1;
        }
    }

    //mostrar por estudiante las compras en los diferentes establecimientos
    // ordenados por fechas
    function getComprasEstudiantes($idUsuario) {

        $getCompras = "SELECT idFactura, Fac_Fecha, Fac_Total "
                . "FROM `factura`"
                . "WHERE Usuario_id_Doc_Identidad1 = '$idUsuario'"
                . "ORDER By Fac_Fecha";

        $success = mysql_query($getCompras) or die(mysql_error());

        if ($success) {
            $arr = [];
            $count = 0;

            while ($row = mysql_fetch_row($success)) {
                $arr[$count] = $row;
                $count++;
            }
         //returns a list of lists
         return json_encode($arr);
        } else {
            return -1;
        }
    }
  
  //consultar una factura para ver los productos comprados
  function getProdPorFactura($idFactura) {

       $getProductos = "SELECT `Producto_id_Producto`"
                . " FROM `factura_has_producto`"
                . "     WHERE Factura_idFactura = '$idFactura'";

        $success = mysql_query($getProductos) or die(mysql_error());

        if ($success) {
            $arr = [];
            $count = 0;

            while ($row = mysql_fetch_row($success)) {
                $arr[$count] = $row;
                $count++;
            }

            return json_encode($arr);
        } else {
            return -1;
        }
    }

  //sacar promedio de ventas del establecimiento deseado
  
  function getAverageEstablishment($nombreEst){
      
      $getAverage = "SELECT avg(Fac_Total) as promedio_ventas, establecimiento.Est_Nombre as Establecimiento "
              . "FROM `factura`, `establecimiento`"
              . "WHERE factura.Establecimiento_id_Establecimiento = establecimiento.id_Establecimiento "
              . "and `establecimiento`.Est_Nombre = '$nombreEst'";
      
     $success = mysql_query($getAverage) or die(mysql_error());
     
     if($success){
         $fArr = mysql_fetch_array($success);
         return json_encode($fArr);
     }else{
         return -1;
     }
  }
  
  //sacar promedio de ventas del establecimiento dado un idEstablecimiento
  function getAVGEstByID($idEstablecimiento){
      
      $getAverage = "SELECT avg(Fac_Total) as promedio_ventas, establecimiento.Est_Nombre as Establecimiento "
              . "FROM `factura`, `establecimiento`"
              . "WHERE factura.Establecimiento_id_Establecimiento = establecimiento.id_Establecimiento "
              . "and `establecimiento`.id_Establecimiento = '$idEstablecimiento'";
      
     $success = mysql_query($getAverage) or die(mysql_error());
     
     if($success){
         $fArr = mysql_fetch_array($success);
         return json_encode($fArr[0]);
     }else{
         return -1;
     }
  }
  
  //productos vendidos en determinado mes
  function getProdsVenMes($desdeMes, $hastaMes) {

        $getProd = "SELECT DISTINCT Prod_Descripcion "
                . "FROM `producto`, `factura` , `factura_has_producto` "
                . "WHERE producto.id_Producto = factura_has_producto.Producto_id_Producto && "
                . "factura.idFactura = factura_has_producto.Factura_idFactura && "
                . "factura.Fac_Fecha > '$desdeMes' && factura.Fac_Fecha < '$hastaMes'";

        $success = mysql_query($getProd) or die(mysql_error());

        if ($success) {
            $arr = [];
            $count = 0;

            while ($row = mysql_fetch_row($success)) {
                $arr[$count] = $row;
                $count++;
            }

            return json_encode($arr);
        } else {
            return -1;
        }
    }
    
    //cuenta el número de facturas que se ha realizado en un establecimiento
    function countFacturas($idEstablecimiento) {
        
        $quieryp = "SELECT COUNT(DISTINCT idFactura)
                        FROM factura
                            WHERE Establecimiento_id_Establecimiento =
                            '$idEstablecimiento'";
        
        $querIt = mysql_query($quieryp) or die(mysql_error());

        
        if ($querIt) {
            $fArr = mysql_fetch_array($querIt);
            //exito no existe
            return $fArr[0];
        } else {
            //existe factura
            return -1;
        }
    }
   
    
    //cuales productos ha vendido el establecimiento
    function getCualesProdEstablecimiento($idEstablecimiento) {

        $getProd = "SELECT distinct( producto.Prod_Descripcion),"
                . " establecimiento.Est_Nombre "
                . "FROM producto, establecimiento, factura, factura_has_producto "
                . "WHERE producto.id_Producto = "
                . "factura_has_producto.Producto_id_Producto "
                . "&& factura_has_producto.Factura_idFactura = "
                . "factura.idFactura && "
                . "factura.Establecimiento_id_Establecimiento ="
                . " establecimiento.id_Establecimiento &&"
                . " Establecimiento_id_Establecimiento='$idEstablecimiento'";

        $query = mysql_query($getProd) or die(mysql_error());

        if ($query) {
            $arr = [];
            $count = 0;
            
            while($row = mysql_fetch_row($query)){
                $arr[$count] = $row[0];
                $count++;
            }
            
            return json_encode($arr);
        } else {
            return -1;
        }
    }
    
    //cuantos productos ha vendido el establecimiento
    function getNumeroProdEstablecimiento($idEstablecimiento) {

        $getProd = "SELECT count(distinct( producto.Prod_Descripcion)),"
                . " establecimiento.Est_Nombre "
                . "FROM producto, establecimiento, factura, factura_has_producto "
                . "WHERE producto.id_Producto = "
                . "factura_has_producto.Producto_id_Producto "
                . "&& factura_has_producto.Factura_idFactura = "
                . "factura.idFactura && "
                . "factura.Establecimiento_id_Establecimiento ="
                . " establecimiento.id_Establecimiento &&"
                . " Establecimiento_id_Establecimiento='$idEstablecimiento'";

        $query = mysql_query($getProd) or die(mysql_error());

        if ($query) {
            $arr = [];
            $count = 0;
            
            while($row = mysql_fetch_row($query)){
                $arr[$count] = $row[0];
                $count++;
            }
            
            return json_encode($arr);
        } else {
            return -1;
        }
    }
    
    //cuales productos tiene un establecimiento por marca
    function getCualesProd() {

        $getCuales = "SELECT Prod_Descripcion, Prod_Marca"
                . " FROM `producto` "
                . "ORDER BY Prod_Marca";

        $success = mysql_query($getCuales) or die(mysql_error());

        if ($success) {

            $arr = [];
            $count = 0;

            while ($row = mysql_fetch_row($success)) {
                $arr[$count] = $row;
                $count++;
            }
            return json_encode($arr);
        } else {
            return -1;
        }
    }
    
    //cuantos productos tiene un establecimiento por marca
    function getCountProd() {

        $getCuales = "SELECT COUNT producto.id_Producto, DISTINCT producto.Prod_Marca"
                . " FROM `producto`";

        $success = mysql_query($getCuales) or die(mysql_error());

        if ($success) {

            $arr = [];
            $count = 0;

            while ($row = mysql_fetch_row($success)) {
                $arr[$count] = $row;
                $count++;
            }
            return json_encode($arr);
        } else {
            return -1;
        }
    }
    
    //cuanto ha vendido el establecimiento por tarjeta!
    function getValorVentaTarjeta($idEst){
        
        $query = "SELECT SUM(Fact_ValorCarnet),establecimiento.Est_Nombre"
                . " FROM `establecimiento`, `factura` "
                . " WHERE factura.Establecimiento_id_Establecimiento ="
                . " establecimiento.id_Establecimiento &&"
                . " establecimiento.id_Establecimiento = '$idEst'";
        
        $success = mysql_query($query) or die(mysql_error());
        
        if($success){
            $valor = mysql_fetch_array($success);
            return $valor[0];   
        }else{
            return -1;
        }
    }

    //verificar si empleado es dueño del local
    function isOwner($idUsuario) {

        $query = "SELECT propietario.id_Doc_Identidad "
                . "FROM `usuario`,`propietario`"
                . " WHERE usuario.id_Doc_Identidad = propietario.Usuario_id_Doc_Identidad &&"
                . " propietario.Usuario_id_Doc_Identidad = '$idUsuario'";

        $success = mysql_query($query) or die(mysql_error());

        if ($success) {
            $fArr = mysql_fetch_array($success);
            return $fArr['id_Doc_Identidad'];
        } else {
            return -1;
        }
    }

}

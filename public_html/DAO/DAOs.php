<?php

include_once 'DatabaseConc.php';

class DAOs {

    private $datab;
    private $connector;
    public static $Dao_user_info;

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
        
        if (empty($tablaX)or empty($campoY) or empty($elementoZ)) {
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
    
    function insertUsuario($id_Usuario, $usu_nombre, $usu_apellido,
            $usu_contrasena, $usu_correo, $usu_profesion) {

        if (empty($id_Usuario) or empty($usu_nombre) or empty($usu_apellido) or
                empty($usu_contrasena) or empty($usu_correo) or empty($usu_profesion)) {
            return false;
        }
        $enc = md5($usu_contrasena);
        $in = "INSERT INTO `tbl_usuario`(id_Usuario,usu_nombre,usu_apellido,
                             usu_contrasena,usu_correo,usu_profesion)
                    VALUES('$id_Usuario','$usu_nombre','$usu_apellido',
                        '$enc','$usu_correo','$usu_profesion')";

        $success = mysql_query($in) or die(mysql_error());

        if ($success) {
            echo "usuario '$usu_nombre' agregado exitosamente.";
        } else {
            echo "Error al agregar el usuario deseado.";
        }
    }
    
    //funcion para verificar si el usuario y contraseña son correctos
     function validarUsuario($usuario, $password) {
        $usuario = str_replace("'", "''", $usuario);
        $password = md5($password);

        $verify = "SELECT usu_contrasena FROM `Tbl_usuario`
                        WHERE usu_nombre = '$usuario'";
        $success = mysql_query($verify) or die(mysql_error());
        if (!$success || (mysql_num_rows($success) < 1)) {
            return 1; //failed to verify
        }

        $dbArray = mysql_fetch_array($success);

        if ($password == $dbArray['usu_contrasena']) {
            echo 0; //yep user exists.
        } else {
            echo 1; //falla;
        }
    }
    
}

?>
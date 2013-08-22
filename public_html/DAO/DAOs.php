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
    
    function nuevoUsuario($id_Usuario, $usr_nombre, $usr_apellidos,
            $usr_password, $usr_correo,$usr_tipoDoc) {

        if (empty($id_Usuario) or empty($usr_nombre) or empty($usr_apellidos) or
                empty($usr_password) or empty($usr_correo) or empty($usr_tipoDoc)) {
            return false;
        }
        
        $enc = md5($usr_password);
        $in = "INSERT INTO `usuario`(id_Doc_Identidad,Usr_Nombres,Usr_Apellidos,
                             Usr_Password,Usr_Correo, Usr_Tipo_Documento)
                    VALUES('$id_Usuario','$usr_nombre','$usr_apellidos',
                        '$enc','$usr_correo',''$usr_tipoDoc)";

        $success = mysql_query($in) or die(mysql_error());

        if ($success) {
            echo "usuario '$usr_nombre' agregado exitosamente.";
        } else {
            echo "Error al agregar el usuario deseado.";
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
            return 1; //failed to verify
        }

        $dbArray = mysql_fetch_array($success);

        if ($password == $dbArray['Usr_Password']) {
            echo 0; //yep user exists.
        } else {
            echo 1; //falla;
        }
    }
    
}

?>
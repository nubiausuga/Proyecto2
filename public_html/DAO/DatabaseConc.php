<?php

include_once 'DatabaseLogin.php';

class DatabaseConc {

    public static $connection;
    public $con;

    private function __construct() {
        $log = new DatabaseLogin();
        $this->con =
                mysql_connect($log->getDbLocalHost(),
                        $log->getDbUsername(),
                        $log->getDbPassword())
                or die("Error conectando a la base de datos: <br/>" . mysql_error());

        mysql_select_db($log->getDatabase(), $this->con) or
                die("Error conectando a la base de datos: <br/>" . mysql_error());
    }

    public function getConnection() {
        return $this->con;
    }

    public static function instance() {

        if (!isset(self::$connection)) {
            self::$connection = new DatabaseConc();
            return self::$connection;
        } else {
            return self::$connection;
        }
    }

}

?>
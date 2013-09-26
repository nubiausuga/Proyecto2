<?php

class Usuario {

    private $idDocUsuario;
    private $nombreUsuario;
    private $apellidosUsuario;
    private $passwordUsuario;
    private $emailUsuario;
    private $tipoDocumentoUsuario;

    function __construct($idUsuario, $nombreUsuario, $apellidoUsuario, $passwordUsuario, $emailUsuario, $tipoDocumentoUsuario) {
        $this->idDocUsuario = $idUsuario;
        $this->nombreUsuario = $nombreUsuario;
        $this->apellidosUsuario = $apellidoUsuario;
        $this->passwordUsuario = $passwordUsuario;
        $this->emailUsuario = $emailUsuario;
        $this->tipoDocumentoUsuario = $tipoDocumentoUsuario;
    }

    //en caso de que por error se quiera hacer echo de un objeto
    function __toString() {
        echo "Usando el metodo toString: ";
        return $this->getNombreUsuario();
    }

    public function getTipoDocumentoUsuario() {
        return $this->tipoDocumentoUsuario;
    }

    public function setTipoDocumentoUsuario($tipoDocumentoUsuario) {
        $this->tipoDocumentoUsuario = $tipoDocumentoUsuario;
    }

    public function getIdUsuario() {
        return $this->idDocUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idDocUsuario = $idUsuario;
    }

    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function getApellidoUsuario() {
        return $this->apellidosUsuario;
    }

    public function setApellidoUsuario($apellidoUsuario) {
        $this->apellidosUsuario = $apellidoUsuario;
    }

    public function getPasswordUsuario() {
        return $this->passwordUsuario;
    }

    public function setPasswordUsuario($passwordUsuario) {
        $this->passwordUsuario = $passwordUsuario;
    }

    public function getEmailUsuario() {
        return $this->emailUsuario;
    }

    public function setEmailUsuario($emailUsuario) {
        $this->emailUsuario = $emailUsuario;
    }

    public function asStudent($givenId) {

        $temp = $givenId;
        $year = substr($temp, 0, 4);
        $semester = substr($temp, 4, 1);
        $identificator = substr($temp, 5, 4);
        $career = substr($temp, 9);

        echo ("Welcome student # " . $identificator . " registered in " . $career . " " . $year . " " . $semester . " semester");
    }

    function asUnderAged($givenID) {
        $temp = $givenID;
        $year = substr($temp, 0, 1);
        $month = substr($temp, 2, 1);
        $day = substr($temp, 4, 1);
        $ident = substr($temp, 6);

        echo("Welcome minor " . $ident . " who was born on day " . $day . " month " . $month . " of the year " . $year);
    }

    function asIDCard($givenId) {
        echo("sorry " . $givenId . " function not yet implemented");
    }

    function idVerifier($givenId) {

        if (is_string($givenId)) {
            $stringLenth = strlen($givenId);

            switch ($stringLenth) {
                case 12:
                    $this->asStudent($givenId);
                    break;
                case 11:
                    $this->asUnderAged($givenId);
                    break;
                case 10:
                    $this->asIDCard($givenId);
                    break;
                default : echo "Sorry, invalid id, please verify it";
            }
        }
        else
            return 0;
    }

    function __destruct() {
        ; //echo 'The class "', __CLASS__, '" was destroid! .<br>';
    }

    function careerVer($careerId) {

        $idC = substr($careerId, 9);
        $array = array(
            10 => "Ingenieria de Sistemas",
            4 => "Ingenieria de Procesos",
            12 => "Ingenieria de Produccion",
            13 => "Ingenieria Civil",
            14 => "Ingenieria Mecanica",
            85 => "Ingenieria de Diseño de Producto",
            3 => "Economia",
            84 => "Derecho",
            83 => "Musica",
            101 => "Ingenieria Matematica",
            111 => "Ciencias Politicas",
            112 => "Comunicacion Social",
            113 => "Ingenieria Fisica",
            183 => "Biologia",
            1 => "Administracion de negocios",
            2 => "Negocios Internacionales",
            11 => "Contaduria Publica",
            168 => "Psicologia",
            169 => "Mercadeo",
        );
        $i = (int) $idC;
        // var_dump($array[169]);
        echo $array[$i];
    }

}

?>

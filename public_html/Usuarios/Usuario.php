<?php

class Usuario {

    private $idUsuario;
    private $nombreUsuario;
    private $apellidoUsuario;
    private $passwordUsuario;
    private $emailUsuario;

    function __construct($idUsuario, $nombreUsuario, $apellidoUsuario,
            $passwordUsuario, $emailUsuario) {
        $this->idUsuario = $idUsuario;
        $this->nombreUsuario = $nombreUsuario;
        $this->apellidoUsuario = $apellidoUsuario;
        $this->passwordUsuario = $passwordUsuario;
        $this->emailUsuario = $emailUsuario;
    }

    //en caso de que por error se quiera hacer echo de un objeto
    function __toString() {
        echo "Usando el metodo toString: ";
        return $this->getNombreUsuario();
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function getApellidoUsuario() {
        return $this->apellidoUsuario;
    }

    public function setApellidoUsuario($apellidoUsuario) {
        $this->apellidoUsuario = $apellidoUsuario;
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

    function __destruct() {
        ; //echo 'The class "', __CLASS__, '" was destroid! .<br>';
    }

}

?>

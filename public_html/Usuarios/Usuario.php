<?php

class Usuario {

    private $idDocUsuario;
    private $nombreUsuario;
    private $apellidosUsuario;
    private $passwordUsuario;
    private $emailUsuario;
    private $tipoDocumentoUsuario;
    public $logged = -1;
    
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

      public function getLogged() {
        return $this->logged;
    }

    public function setLogged($logged) {
        $this->logged = $logged;
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

    function __destruct() {
        ; //echo 'The class "', __CLASS__, '" was destroid! .<br>';
    }

}
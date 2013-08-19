<?php

class Usuario {

    private $idUsuario;
    private $nombreUsuario;
    private $apellidoUsuario;
    private $passwordUsuario;
    private $emailUsuario;
    private $profesionUsuario;

    function __construct($idUsuario, $nombreUsuario, $apellidoUsuario,
            $passwordUsuario, $emailUsuario, $profesionUsuario) {
        $this->idUsuario = $idUsuario;
        $this->nombreUsuario = $nombreUsuario;
        $this->apellidoUsuario = $apellidoUsuario;
        $this->passwordUsuario = $passwordUsuario;
        $this->emailUsuario = $emailUsuario;
        $this->profesionUsuario = $profesionUsuario;
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

    public function getProfesionUsuario() {
        return $this->profesionUsuario;
    }

    public function setProfesionUsuario($profesionUsuario) {
        $this->profesionUsuario = $profesionUsuario;
    }
    
}

?>

<?php

class Estudiante extends Usuario {

    private $idEstudiante;
    private $carreraEstudiante;

    function __construct($idUsuario, $nombreUsuario, $apellidoUsuario,
            $passwordUsuario, $emailUsuario, $idEstudiante, $carreraEstudiante) {
        parent::__construct($idUsuario, $nombreUsuario, $apellidoUsuario,
                $passwordUsuario, $emailUsuario);

        $this->idEstudiante = $idEstudiante;
        $this->carreraEstudiante = $carreraEstudiante;
    }

    public function getIdEstudiante() {
        return $this->idEstudiante;
    }

    public function setIdEstudiante($idEstudiante) {
        $this->idEstudiante = $idEstudiante;
    }

    public function getCarreraEstudiante() {
        return $this->carreraEstudiante;
    }

    public function setCarreraEstudiante($carreraEstudiante) {
        $this->carreraEstudiante = $carreraEstudiante;
    }
    
    function __toString() {
        echo "Usando el metodo toString: ";
        return $this->getIdEstudiante();
    }

}

?>

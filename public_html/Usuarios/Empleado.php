<?php

class Empleado extends Usuario {

    private $cedulaEmpleado;
    private $establecimientoEmpleado;
    private $cargoEmpleado;

    function __construct($idUsuario, $nombreUsuario, $apellidoUsuario,
            $passwordUsuario, $emailUsuario, $cedulaEmpleado,
            $establecimientoEmpleado, $cargoEmpleado) {
        parent::__construct($idUsuario, $nombreUsuario, $apellidoUsuario,
                $passwordUsuario, $emailUsuario);

        $this->cedulaEmpleado = $cedulaEmpleado;
        $this->establecimientoEmpleado = $establecimientoEmpleado;
        $this->cargoEmpleado = $cargoEmpleado;
    }

    public function getCedulaEmpleado() {
        return $this->cedulaEmpleado;
    }

    public function setCedulaEmpleado($cedulaEmpleado) {
        $this->cedulaEmpleado = $cedulaEmpleado;
    }

    public function getEstablecimientoEmpleado() {
        return $this->establecimientoEmpleado;
    }

    public function setEstablecimientoEmpleado($establecimientoEmpleado) {
        $this->establecimientoEmpleado = $establecimientoEmpleado;
    }

    public function getCargoEmpleado() {
        return $this->cargoEmpleado;
    }

    public function setCargoEmpleado($cargoEmpleado) {
        $this->cargoEmpleado = $cargoEmpleado;
    }
    
    function __toString() {
        echo "Usando el metodo toString: ";
        return $this->getCedulaEmpleado();
    }

}

?>

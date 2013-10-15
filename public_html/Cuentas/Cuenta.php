<?php

class Cuenta {

    private $idCuenta;
    private $idUsuarioCuenta;
    private $saldoCuenta;
    private $estadoCuenta;

    function __construct($idCuenta, $idUsuarioCuenta,
            $saldoCuenta, $estadoCuenta) {
        $this->idCuenta = $idCuenta;
        $this->idUsuarioCuenta = $idUsuarioCuenta;
        $this->saldoCuenta = $saldoCuenta;
        $this->estadoCuenta = $estadoCuenta;
    }

    public function getIdCuenta() {
        return $this->idCuenta;
    }

    public function setIdCuenta($idCuenta) {
        $this->idCuenta = $idCuenta;
    }

    public function getIdUsuarioCuenta() {
        return $this->idUsuarioCuenta;
    }

    public function setIdUsuarioCuenta($idUsuarioCuenta) {
        $this->idUsuarioCuenta = $idUsuarioCuenta;
    }

    public function getSaldoCuenta() {
        return $this->saldoCuenta;
    }

    public function setSaldoCuenta($saldoCuenta) {
        $this->saldoCuenta = $saldoCuenta;
    }

    public function getEstadoCuenta() {
        return $this->estadoCuenta;
    }

    public function setEstadoCuenta($estadoCuenta) {
        $this->estadoCuenta = $estadoCuenta;
    }

    function __toString() {
        echo "Usando metodo toString de objetos, IdCuenta: ";
        return $this->getIdCuenta();
    }

}

?>

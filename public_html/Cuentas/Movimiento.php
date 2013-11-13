<?php

class Movimiento {

    private $idMovimiento;
    private $idEstablecimiento;
    private $descripcionMovimiento;
    private $fechaMovimiento;
    private $valorMovimiento;
    private $idCuenta;

    function __construct($idMovimiento, $idEstablecimiento,
            $descripcionMovimiento, $fechaMovimiento,
            $valorMovimiento, $idCuenta) {
        $this->idMovimiento = $idMovimiento;
        $this->idEstablecimiento = $idEstablecimiento;
        $this->descripcionMovimiento = $descripcionMovimiento;
        $this->fechaMovimiento = $fechaMovimiento;
        $this->valorMovimiento = $valorMovimiento;
        $this->idCuenta = $idCuenta;
    }

    public function getIdMovimiento() {
        return $this->idMovimiento;
    }

    public function setIdMovimiento($idMovimiento) {
        $this->idMovimiento = $idMovimiento;
    }

    public function getIdEstablecimiento() {
        return $this->idEstablecimiento;
    }

    public function setIdEstablecimiento($idEstablecimiento) {
        $this->idEstablecimiento = $idEstablecimiento;
    }

    public function getDescripcionMovimiento() {
        return $this->descripcionMovimiento;
    }

    public function setDescripcionMovimiento($descripcionMovimiento) {
        $this->descripcionMovimiento = $descripcionMovimiento;
    }

    public function getFechaMovimiento() {
        return $this->fechaMovimiento;
    }

    public function setFechaMovimiento($fechaMovimiento) {
        $this->fechaMovimiento = $fechaMovimiento;
    }

    public function getValorMovimiento() {
        return $this->valorMovimiento;
    }

    public function setValorMovimiento($valorMovimiento) {
        $this->valorMovimiento = $valorMovimiento;
    }

    public function getIdCuenta() {
        return $this->idCuenta;
    }

    public function setIdCuenta($idCuenta) {
        $this->idCuenta = $idCuenta;
    }

    function __toString() {
        echo "usando metodo toString_obj,idMovimiento: ";
        return $this->getIdMovimiento();
    }

}

?>

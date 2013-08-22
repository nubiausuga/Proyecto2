<?php

class Establecimiento{
    private $idEstablecimiento;
    private $estNombre;
    private $estResponsable;
    private $tipoEstablecimiento;
    
    function __construct($idEstablecimiento,$estNombre,$estResponsable, $tipoEstablecimiento) {
        $this->idEstablecimiento = $idEstablecimiento;
        $this->estNombre = $estNombre;
        $this->estResponsable = $estResponsable;
        $this->tipoEstablecimiento = $tipoEstablecimiento;
        
    }
    
    public function getIdEstablecimiento() {
        return $this->idEstablecimiento;
    }

    public function setIdEstablecimiento($idEstablecimiento) {
        $this->idEstablecimiento = $idEstablecimiento;
    }

    public function getEstNombre() {
        return $this->estNombre;
    }

    public function setEstNombre($estNombre) {
        $this->estNombre = $estNombre;
    }

    public function getEstResponsable() {
        return $this->estResponsable;
    }

    public function setEstResponsable($estResponsable) {
        $this->estResponsable = $estResponsable;
    }

    public function getTipoEstablecimiento() {
        return $this->tipoEstablecimiento;
    }

    public function setTipoEstablecimiento($tipoEstablecimiento) {
        $this->tipoEstablecimiento = $tipoEstablecimiento;
    }

    function __toString() {
        echo "Usando metodo toString de objetos, IdEstablecimiento: ";
        return $this->getIdEstablecimiento();
    }
}
?>

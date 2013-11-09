<?php

class Establecimiento{
    private $idEstablecimiento;
    private $estNombre;
    private $estResponsable;
    private $tipoEstablecimiento;
    private $idResponsable;
    
    function __construct($idEstablecimiento,$estNombre,$estResponsable,
            $tipoEstablecimiento, $idResponsable) {
        
        $this->idEstablecimiento = $idEstablecimiento;
        $this->estNombre = $estNombre;
        $this->estResponsable = $estResponsable;
        $this->tipoEstablecimiento = $tipoEstablecimiento;
        $this->idResponsable = $idResponsable;
        
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
    public function getIdResponsable() {
        return $this->idResponsable;
    }

    public function setIdResponsable($idResponsable) {
        $this->idResponsable = $idResponsable;
    }

    function convertNit($nit) {

        $originalStr = $nit;
        $first = substr($nit, 0, 3);
        $middle = substr($nit, 4, 3);
        $end = substr($nit, 8, 3);
        $especial = substr($nit, 12, 1);
        $estId = (int) $first . $middle . $end . $especial;
        return $estId;
    }

    function __toString() {
        echo "Usando metodo toString de objetos, IdEstablecimiento: ";
        return $this->getIdEstablecimiento();
    }

}
?>

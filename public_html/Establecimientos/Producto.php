<?php

class Producto {

    private $idProducto;
    private $descProducto;
    private $precioProducto;

    function __construct($idProducto, $descProducto, $precioProducto) {
        $this->idProducto = $idProducto;
        $this->descProducto = $descProducto;
        $this->precioProducto = $precioProducto;
    }

    public function getIdProducto() {
        return $this->idProducto;
    }

    public function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    public function getDescProducto() {
        return $this->descProducto;
    }

    public function setDescProducto($descProducto) {
        $this->descProducto = $descProducto;
    }

    public function getPrecioProducto() {
        return $this->precioProducto;
    }

    public function setPrecioProducto($precioProducto) {
        $this->precioProducto = $precioProducto;
    }


}

?>

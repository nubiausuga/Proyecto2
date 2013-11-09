<?php

class Producto {

    private $idProducto;
    private $descProducto;
    private $precioProducto;
    private $marcaProducto;
    
    function __construct($idProducto, $descProducto, $precioProducto,
            $marcaProducto) {

        $this->idProducto = $idProducto;
        $this->descProducto = $descProducto;
        $this->precioProducto = $precioProducto;
        $this->marcaProducto = $marcaProducto;
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
    public function getMarcaProducto() {
        return $this->marcaProducto;
    }

    public function setMarcaProducto($marcaProducto) {
        $this->marcaProducto = $marcaProducto;
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



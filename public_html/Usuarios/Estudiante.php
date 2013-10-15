<?php

class Estudiante extends Usuario {

    private $carreraEstudiante;
    private $enrolledYear;
    private $enrolledSemester;
    private $studentIdentificator;
    

    function __construct($idUsuario, $nombreUsuario, $apellidoUsuario, $passwordUsuario, $emailUsuario, $tipoDocumento, $carreraEstudiante) {
        parent::__construct($idUsuario, $nombreUsuario, $apellidoUsuario, $passwordUsuario, $emailUsuario, $tipoDocumento);

        $this->carreraEstudiante = $carreraEstudiante;
    }

    public function getIdEstudiante() {
        return $this->idEstudiante;
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
    //funcionalidad para agregar información extra al objeto
    //todavía no se encuentra en la base de datos.
    function addExtraInfo($givenId){
        
        $temp = $givenId;
        $year = substr($temp, 0, 4);
        $semester = substr($temp, 4, 1);
        $identificator = substr($temp, 5, 4);
        
        $this->enrolledYear = $year;
        $this->enrolledSemester = $semester;
        $this->studentIdentificator = $identificator;
    }
    
    //Identificador de que carrera esta el estudiante dado el código
    public function asStudent($givenId) {

        $temp = $givenId;
        $career = substr($temp, 9);
        $this->addExtraInfo($givenId);
        $this->setCarreraEstudiante($this->careerVer($givenId));
    }

    function idVerifier($givenId) {

        if (is_string($givenId)) {
            $stringLenth = strlen($givenId);

            switch ($stringLenth) {
                case 12:
                    $this->asStudent($givenId);
                    break;
                case 11:
                    $this->asUnderAged($givenId);
                    break;
                case 10:
                    $this->asIDCard($givenId);
                    break;
                default : echo "Sorry, invalid id, please verify it";
            }
        }
        else
            return 0;
    }
    
    //hash-table que contiene el código identificador de las carreras 
    // en la universidad eafit.
    function careerVer($careerId) {

        $idC = substr($careerId, 9);
        $array = array(
            
            10 => "Ingenieria de Sistemas",
            4 => "Ingenieria de Procesos",
            12 => "Ingenieria de Produccion",
            13 => "Ingenieria Civil",
            14 => "Ingenieria Mecanica",
            85 => "Ingenieria de Diseño de Producto",
            3 => "Economia",
            84 => "Derecho",
            83 => "Musica",
            101 => "Ingenieria Matematica",
            111 => "Ciencias Politicas",
            112 => "Comunicacion Social",
            113 => "Ingenieria Fisica",
            183 => "Biologia",
            1 => "Administracion de negocios",
            2 => "Negocios Internacionales",
            11 => "Contaduria Publica",
            168 => "Psicologia",
            169 => "Mercadeo",
        );
        $i = (int) $idC;
        
        if($i == 1 || $i == 2 || $i == 3 || $i == 4 || $i == 10 || 
                $i == 11 || $i == 12 || $i == 13 || $i == 14 || $i == 83 ||
                $i == 84 || $i == 85 || $i == 101 || $i == 111 || $i == 112 ||
                $i == 113 || $i == 168 || $i == 169 || $i == 183){
            return $array[$i];
        }else{
            return -1;
        }
        //return $array[$i];
    }
    
    //en caso de que no tenga carnet estudiantil.
    //TODO 
    function asUnderAged($givenID) {
        $temp = $givenID;
        $year = substr($temp, 0, 1);
        $month = substr($temp, 2, 1);
        $day = substr($temp, 4, 1);
        $ident = substr($temp, 6);

        echo("Welcome minor " . $ident . " who was born on day " .
        $day . " month " . $month . " of the year " . $year);
    }

}

?>

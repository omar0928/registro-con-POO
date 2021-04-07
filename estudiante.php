<?php 

class Estudiante{

    public $id;
    public $nombre;
    public $apellido;
    public $carrera;
    public $estado;
    public $profilePhoto;

    private $utilities;

    public function __construct(){
        $this->utilities = New Utilities();
    }

    public function InicializeData($id,$nombre,$apellido,$carrera,$estado){

        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->carrera = $carrera;
        $this->estado = $estado;
    }

    public function set($data){
        foreach($data as $key => $value) $this->{$key} = $value;
    }

    function getCompanyName(){

        if($this->carrera != 0 && $this->carrera != null){
            return $this->utilities->carreras[$this->carrera];
        }
    }
}



?>
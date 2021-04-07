<?php 

class EstudianteServiceCookie implements IServiceBase{
    private $utilities;
    private $cookieName;

    public function __construct(){
        $this->utilities = New Utilities();
        $this->cookieName = 'estudiantes';
    }

    public function GetList(){
        $listadoEstudiante = array();
    
        if(isset($_COOKIE[$this->cookieName])){
            $listadoEstudianteDecode = json_decode($_COOKIE[$this->cookieName],false);

            foreach($listadoEstudianteDecode as $elementDecode){
                $element = new Estudiante();
                $element->set($elementDecode);

                array_push($listadoEstudiante, $element);
            }

        }else{ 
            setcookie($this->cookieName,json_encode($listadoEstudiante),$this->utilities->GetCookieTime(),"/");
        }
        return $listadoEstudiante;
    }

    public function GetById($id){
        $listadoEstudiante = $this->GetList();
        $estudiante = $this->utilities->searchProperty($listadoEstudiante,'id',$id)[0];
        
        return $estudiante;
    }

    public function Add($entity){
        $listadoEstudiante = $this->GetList();
        $estudianteId = 1;

        if(!empty($listadoEstudiante)){
            $lastEstudiante = $this->utilities->getLastElement($listadoEstudiante);
            $estudianteId = $lastEstudiante->id + 1;
        }

        $entity->id = $estudianteId;

        $entity->profilePhoto = "";

        if(isset($_FILES['profilePhoto'])){

            $photoFile = $_FILES['profilePhoto'];

            if($photoFile['error'] == 4){
                $entity->profliePhoto = "";
            }else{

            $typeReplace = str_replace("image/","",$_FILES['profilePhoto']['type']);
            $type = $photoFile['type'];
            $size = $photoFile['size'];
            $name = $estudianteId. '.'.$typeReplace;
            $tmpname = $photoFile['tmp_name'];

            $success = $this->utilities->uploadImage('fotoEstudiante/',$name,$tmpname,$type,$size);

            if($success){
                $entity->profilePhoto = $name;
            }  
        }
    }

        array_push($listadoEstudiante,$entity);

        setcookie($this->cookieName,json_encode($listadoEstudiante),$this->utilities->GetCookieTime(),"/");
    }

    public function Update($id,$entity){
        
        $element = $this->GetById($id);
        $listadoEstudiante = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($listadoEstudiante,'id',$id);

        if(isset($_FILES['profilePhoto'])){

            $photoFile = $_FILES['profilePhoto'];

            if($photoFile['error'] == 4){
                $entity->profliePhoto = $element->profilePhoto;
            }else{
                 $typeReplace = str_replace("image/","",$_FILES['profilePhoto']['type']);
            $type = $photoFile['type'];
            $size = $photoFile['size'];
            $name = $id. '.'.$typeReplace;
            $tmpname = $photoFile['tmp_name'];

            $success = $this->utilities->uploadImage('fotoEstudiante',$name,$tmpname,$type,$size);

            if($success){
                $entity->profilePhoto = $name;
            } 
        }   
    }

        $listadoEstudiante[$elementIndex] = $entity;
    
        setcookie($this->cookieName,json_encode($listadoEstudiante),$this->utilities->GetCookieTime(),"/");


    }

    public function Delete($id){
        $listadoEstudiante = $this->GetList();
        $elementIndex = $this->utilities->getIndexElement($listadoEstudiante,'id',$id);

        unset($listadoEstudiante[$elementIndex]);

        $listadoEstudiante = array_values($listadoEstudiante);

        setcookie($this->cookieName,json_encode($listadoEstudiante),$this->utilities->GetCookieTime(),"/");
    }
}
?>
<?php


/**
 * Description of AsignaturaClass
 *
 * @author musef2904@gmail.com
 */
class AsignaturaClass {
    
    public $id;
    public $nombre;
    public $id_estudio;
    
        
    public function getId():int {
        return $this->id;
    }

    
    public function getNombre():string {
        return $this->nombre;
    }
    
    
    public function setNombre($nombre):void {
        $this->nombre = $nombre;
    }
    
    
    public function getIdEstudio():int {
        return $this->id_estudio;
    } 
    
    
    public function setIdEstudio($idEstudio):void {
        $this->id_estudio = $idEstudio;
    }     
    
}

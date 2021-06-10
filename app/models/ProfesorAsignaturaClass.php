<?php


/**
 * Description of ProfesorAsignaturaClass
 *
 * @author musef2904@gmail.com
 */
class ProfesorAsignaturaClass {
    
    public $id;
    public $id_profesor;
    public $id_asignatura;

    
        
    public function getId():int {
        return $this->id;
    }

    
    public function getIdAsignatura():int {
        return $this->id_asignatura;
    }
    
    
    public function setIdAsignatura($idAsignatura):void {
        $this->id_asignatura = $idAsignatura;
    }
    
    
    public function getIdProfesor():int {
        return $this->id_profesor;
    } 
    
    
    public function setIdProfesor($idProfesor):void {
        $this->id_profesor = $idProfesor;
    }     
    
}

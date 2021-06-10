<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/models/ProfesorAsignaturaClass.php';
/**
 * Description of ProfesorAsignaturaClass
 *
 * @author musef2904@gmail.com
 */
class ProfesorAsignaturaExtendedClass extends ProfesorAsignaturaClass {
    
    public $nombre;
    public $asignatura;

        
    public function getNombre():string {
        return $this->nombre;
    }
    
    
    public function setNombre($nombre):void {
        $this->nombre = $nombre;
    }
    
    
    public function getAsignatura():string {
        return $this->asignatura;
    }
    
    
    public function setAsignatura($asignatura):void {
        $this->asignatura = $asignatura;
    }  
    
}

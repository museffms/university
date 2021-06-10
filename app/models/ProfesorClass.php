<?php

/**
 * Description of ProfesorClass
 *
 * @author musef2904@gmail.com
 */
class ProfesorClass {
    
    public $id;
    public $nombre;
    
    
    
    public function getId():int {
        return $this->id;
    }

    
    public function getNombre():string {
        return $this->nombre;
    }
    
    
    public function setNombre($nombre):void {
        $this->nombre = $nombre;
    }
}

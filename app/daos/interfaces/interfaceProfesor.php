<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/models/ProfesorClass.php';

/**
 *
 * @author musef2904@gmail.com
 * Operaciones CRUD + list sobre objeto Profesor
 */
interface interfaceProfesor {
    
    public function create (ProfesorClass $profesor);
    
    public function read (int $idProfesor);
    
    public function update (ProfesorClass $profesor);
    
    public function delete (int $idProfesor);
    
    public function showlist();
    
}

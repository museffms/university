<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/models/AsignaturaClass.php';
/**
 *
 * @author musef2904@gmail.com
 * Operaciones CRUD + list sobre objeto Asignatura
 */
interface interfaceAsignatura {
    
    public function create (AsignaturaClass $asignatura);
    
    public function read (int $idAsignatura);
    
    public function update (AsignaturaClass $asignatura);
    
    public function delete (int $idAsignatura);
    
    public function showlist();
    
}

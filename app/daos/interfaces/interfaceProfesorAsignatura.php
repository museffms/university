<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/models/ProfesorAsignaturaExtendedClass.php';

/**
 *
 * @author musef2904@gmail.com
 * Operaciones CRUD + list sobre objeto ProfesorAsignatura
 */
interface interfaceProfesorAsignatura {
    
    public function create (ProfesorAsignaturaClass $profAsignatura);
    
    public function read (int $idProfAsignatura);
    
    public function update (ProfesorAsignaturaClass $profAsignatura);
    
    public function delete (int $idProfAsignatura);
    
    public function showlist();
    
}

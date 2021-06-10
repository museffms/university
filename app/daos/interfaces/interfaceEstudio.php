<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/models/EstudioClass.php';
/**
 *
 * @author musef2904@gmail.com
 * Operaciones CRUD + list sobre objeto Estudio
 */
interface interfaceEstudio {
    
    public function create (EstudioClass $estudio);
    
    public function read (int $idEstudio);
    
    public function update (EstudioClass $estudio);
    
    public function delete (int $idEstudio);
    
    public function showlist();
    
}

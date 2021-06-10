<?php     
    /*
     * WS_UNIVERSITY
     * 
     * Servicios incluidos:
     * Listado de relaciones todos profesores con sus asignaturas
     * una relación seleccionada por su id     
     */

    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/WSProfesorAsignaturaClass.php';
    
    $main = new WSProfesorAsignaturaClass();
    $main->consultarProfesorAsignatura();
<?php     
    /*
     * WS_UNIVERSITY
     * 
     * Servicios incluidos:
     * Listado de profesores
     */

    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/WSProfesorClass.php';
    
    $main = new WSProfesorClass();
    $main->listarProfesores();
<?php     
    /*
     * WS_UNIVERSITY
     * 
     * Servicios incluidos:
     * Listado de estudios
     */

    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/WSAsignaturaClass.php';
    
    $main = new WSAsignaturaClass();
    $main->consultarAsignatura();
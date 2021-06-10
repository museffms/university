<?php     
    /*
     * WS_UNIVERSITY
     * 
     * Servicios incluidos:
     * Listado de estudios
     */

    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/WSEstudioClass.php';
    
    $main = new WSEstudioClass();
    $main->listarEstudios();
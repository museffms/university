<?php     
    /*
     * WS_UNIVERSITY
     * 
     * Servicios incluidos:
     * Consulta de estudios por id
     */

    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/WSEstudioClass.php';
    
    $main = new WSEstudioClass();
    $main->consultarEstudio();
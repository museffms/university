<?php

    /*
     * WS_UNIVERSITY
     * 
     * Servicios incluidos:
     * Consulta de profesores por id
     */

    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/WSProfesorClass.php';
    
    $main = new WSProfesorClass();
    $main->consultarProfesor();
    
?>


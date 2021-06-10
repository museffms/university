<?php

    /*
     * WS_UNIVERSITY
     * 
     * Servicios incluidos:
     * Consulta de profesores por nombre
     */

    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/WSProfesorClass.php';
    
    $main = new WSProfesorClass();
    $main->listarProfesoresPorNombre();
    
?>


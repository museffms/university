<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set('display_startup_errors', '1');

require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/libs/LibreriaClass.php';

/**
 * Description of WSProfesorClass
 *
 * @author musef2904@gmail.com
 */
class WSProfesorClass extends LibreriaClass {
    
    /**
     * WS consulta de profesor por id
     */
    public function consultarProfesor() {

        // solo se admiten get y/o post
        if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {


            $token = (isset($_REQUEST['__token'])) ? $_REQUEST['__token'] : "";

            if ($this->authorizedToken($token)) {

                if (isset($_REQUEST['id'])) {

                    $id = $this->filterNumber($_REQUEST['id']);
                    
                    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/ProfesorDaoClass.php';
                    
                    $daoprof = new ProfesorDaoClass();
                    $prof=$daoprof->read($id);
                    
                    if (is_null($prof) || $prof===false) {
                        $this->genera_respuesta('400', 'No existen datos o parámetro incorrecto', null);
                    } else {
                        $this->genera_respuesta('200', 'Datos de Profesor obtenidos', $prof);                        
                    }


                } else {
                    // retornamos un error - este servicio no existe
                    $message='Prohibido: Servicio no disponible';           
                    $this->genera_respuesta('403', $message, null);                  
                }

            } else {
                // retornamos un error - este servicio no existe
                $message='Prohibido: Servicio no disponible o no autorizado';           
                $this->genera_respuesta('403', $message, null);              
            }

            exit();        

        } else {
            // error por el método utilizado  
            $this->genera_respuesta('405', 'Método no permitido', null);
            exit();
        }
        
    }
    
    /**
     * WS consulta listado profesores
     */
    public function listarProfesores() {

        // solo se admiten get y/o post
        if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {


            $token = (isset($_REQUEST['__token'])) ? $_REQUEST['__token'] : "";

            if ($this->authorizedToken($token)) {

                if (isset($_REQUEST['list'])) {

                    
                    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/ProfesorDaoClass.php';
                    
                    $daoprof = new ProfesorDaoClass();
                    $prof=$daoprof->showlist();
                    
                    if (is_null($prof) || $prof===false) {
                        $this->genera_respuesta('400', 'No existen datos o parámetro incorrecto', null);
                    } else {
                        $this->genera_respuesta('200', 'Listado de Profesores obtenido', $prof);                        
                    }


                } else {
                    // retornamos un error - este servicio no existe
                    $message='Prohibido: Servicio no disponible';           
                    $this->genera_respuesta('403', $message, null);                  
                }

            } else {
                // retornamos un error - este servicio no existe
                $message='Prohibido: Servicio no disponible o no autorizado';           
                $this->genera_respuesta('403', $message, null);              
            }

            exit();        

        } else {
            // error por el método utilizado  
            $this->genera_respuesta('405', 'Método no permitido', null);
            exit();
        }
        
    }
    
    
    /**
     * WS consulta listado profesores por nombre
     */
    public function listarProfesoresPorNombre() {

        // solo se admiten get y/o post
        if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {


            $token = (isset($_REQUEST['__token'])) ? $_REQUEST['__token'] : "";

            if ($this->authorizedToken($token)) {

                if (isset($_REQUEST['nombre'])) {

                    $nombre = $this->filterText($_REQUEST['nombre']);
                    
                    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/ProfesorDaoClass.php';
                    
                    $daoprof = new ProfesorDaoClass();
                    $prof=$daoprof->showlistByText($nombre);
                    
                    if (is_null($prof) || $prof===false) {
                        $this->genera_respuesta('400', 'No existen datos o parámetro incorrecto', null);
                    } else {
                        $this->genera_respuesta('200', 'Listado de Profesores por nombre obtenido', $prof);                        
                    }


                } else {
                    // retornamos un error - este servicio no existe
                    $message='Prohibido: Servicio no disponible';           
                    $this->genera_respuesta('403', $message, null);                  
                }

            } else {
                // retornamos un error - este servicio no existe
                $message='Prohibido: Servicio no disponible o no autorizado';           
                $this->genera_respuesta('403', $message, null);              
            }

            exit();        

        } else {
            // error por el método utilizado  
            $this->genera_respuesta('405', 'Método no permitido', null);
            exit();
        }
        
    }
        
              
}

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set('display_startup_errors', '1');

require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/libs/LibreriaClass.php';

/**
 * Description of WSAsignaturaClass
 *
 * @author musef2904@gmail.com
 */
class WSAsignaturaClass extends LibreriaClass {
    
    
   /**
    * WS consulta de asignatura por id
    */
    public function consultarAsignatura() {

        // solo se admiten get y/o post
        if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {


            $token = (isset($_REQUEST['__token'])) ? $_REQUEST['__token'] : "";

            if ($this->authorizedToken($token)) {

                if (isset($_REQUEST['id'])) {

                    $id = $this->filterNumber($_REQUEST['id']);
                    
                    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/AsignaturaDaoClass.php';
                    
                    $daoasig = new AsignaturaDaoClass();
                    $asig = $daoasig->read($id);
                    
                    if (is_null($asig) || $asig===false) {
                        $this->genera_respuesta('400', 'No existen datos o parámetro incorrecto', null);
                    } else {
                        $this->genera_respuesta('200', 'Datos de la asignatura obtenidos', $asig);                        
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
     * WS consulta listado todas las asignaturas
     */
    public function listarAsignaturas() {

        // solo se admiten get y/o post
        if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {


            $token = (isset($_REQUEST['__token'])) ? $_REQUEST['__token'] : "";

            if ($this->authorizedToken($token)) {

                if (isset($_REQUEST['list'])) {

                    
                    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/AsignaturaDaoClass.php';
                    
                    $daoasig = new AsignaturaDaoClass();
                    $asig=$daoasig->showlist();
                    
                    if (is_null($asig) || $asig===false) {
                        $this->genera_respuesta('400', 'No existen datos o parámetro incorrecto', null);
                    } else {
                        $this->genera_respuesta('200', 'Listado de Asignaturas obtenido', $asig); 
                    }


                } else {
                    // retornamos un error - asige servicio no existe
                    $message='Prohibido: Servicio no disponible';           
                    $this->genera_respuesta('403', $message, null);                  
                }

            } else {
                // retornamos un error - asige servicio no existe
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
     * WS consulta listado asignatura por asigudio
     */
    public function listarAsignaturaPorEstudio() {

        // solo se admiten get y/o post
        if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {


            $token = (isset($_REQUEST['__token'])) ? $_REQUEST['__token'] : "";

            if ($this->authorizedToken($token)) {

                if (isset($_REQUEST['id'])) {

                    $idEstudio = $this->filterNumber($_REQUEST['id']);
                    
                    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/AsignaturaDaoClass.php';
                    
                    $daoasig = new AsignaturaDaoClass();
                    $asig = $daoasig->showlistByEstudio($idEstudio);
                    
                    if (is_null($asig) || $asig===false) {
                        $this->genera_respuesta('400', 'No existen datos o parámetro incorrecto', null);
                    } else {
                        $this->genera_respuesta('200', 'Listado de Asignaturas por estudio obtenido', $asig); 
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

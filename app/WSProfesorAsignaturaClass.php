<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set('display_startup_errors', '1');

require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/libs/LibreriaClass.php';

/**
 * Description of WSProfesorAsignaturaClass
 *
 * @author musef2904@gmail.com
 */
class WSProfesorAsignaturaClass extends LibreriaClass {
    
    
   /**
    * WS consulta de profesor-asignatura por id
    */
    public function consultarProfesorAsignatura() {

        // solo se admiten get y/o post
        if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {


            $token = (isset($_REQUEST['__token'])) ? $_REQUEST['__token'] : "";

            if ($this->authorizedToken($token)) {

                if (isset($_REQUEST['id'])) {

                    $id = $this->filterNumber($_REQUEST['id']);
                    
                    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/ProfesorAsignaturaDaoClass.php';
                    
                    $daoasig = new ProfesorAsignaturaDaoClass();
                    $asig = $daoasig->read($id);
                    
                    if (is_null($asig) || $asig===false) {
                        $this->genera_respuesta('400', 'No existen datos o parámetro incorrecto', null);
                    } else {
                        $this->genera_respuesta('200', 'Datos de la relación profesor-asignatura obtenido', $asig);                        
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
     * WS consulta listado todas los profesores con sus asignaturas
     */
    public function listarProfesorAsignaturas() {

        // solo se admiten get y/o post
        if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {


            $token = (isset($_REQUEST['__token'])) ? $_REQUEST['__token'] : "";

            if ($this->authorizedToken($token)) {

                if (isset($_REQUEST['list'])) {

                    
                    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/ProfesorAsignaturaDaoClass.php';
                    
                    $daoasig = new ProfesorAsignaturaDaoClass();
                    $asig=$daoasig->showlist();
                    
                    if (is_null($asig) || $asig===false) {
                        $this->genera_respuesta('400', 'No existen datos o parámetro incorrecto', null);
                    } else {
                        $this->genera_respuesta('200', 'Listado de relación profesor-asignatura obtenido', $asig); 
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
     * WS consulta listado relación profesor-asignatura por asignatura
     */
    public function listarRelacionPorAsignatura() {

        // solo se admiten get y/o post
        if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {


            $token = (isset($_REQUEST['__token'])) ? $_REQUEST['__token'] : "";

            if ($this->authorizedToken($token)) {

                if (isset($_REQUEST['id'])) {

                    $idAsignatura = $this->filterNumber($_REQUEST['id']);
                    
                    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/ProfesorAsignaturaDaoClass.php';
                    
                    $daoasig = new ProfesorAsignaturaDaoClass();
                    $asig = $daoasig->showlistByAsignatura($idAsignatura);
                    
                    if (is_null($asig) || $asig===false) {
                        $this->genera_respuesta('400', 'No existen datos o parámetro incorrecto', null);
                    } else {
                        $this->genera_respuesta('200', 'Listado de Relación por asignatura obtenido', $asig); 
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
     * WS consulta listado relación profesor-asignatura por profesor
     */
    public function listarRelacionPorProfesor() {

        // solo se admiten get y/o post
        if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {


            $token = (isset($_REQUEST['__token'])) ? $_REQUEST['__token'] : "";

            if ($this->authorizedToken($token)) {

                if (isset($_REQUEST['id'])) {

                    $idProfesor = $this->filterNumber($_REQUEST['id']);
                    
                    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/ProfesorAsignaturaDaoClass.php';
                    
                    $daoasig = new ProfesorAsignaturaDaoClass();
                    $asig = $daoasig->showlistByProfesor($idProfesor);
                    
                    if (is_null($asig) || $asig===false) {
                        $this->genera_respuesta('400', 'No existen datos o parámetro incorrecto', null);
                    } else {
                        $this->genera_respuesta('200', 'Listado de Relación por profesor obtenido', $asig); 
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
     * WS consulta listado relación profesor-asignatura por estudio
     */
    public function listarRelacionPorEstudio() {

        // solo se admiten get y/o post
        if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {


            $token = (isset($_REQUEST['__token'])) ? $_REQUEST['__token'] : "";

            if ($this->authorizedToken($token)) {

                if (isset($_REQUEST['id'])) {

                    $idEstudio = $this->filterNumber($_REQUEST['id']);
                    
                    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/ProfesorAsignaturaDaoClass.php';
                    
                    $daoasig = new ProfesorAsignaturaDaoClass();
                    $asig = $daoasig->showlistByEstudio($idEstudio);
                    
                    if (is_null($asig) || $asig===false) {
                        $this->genera_respuesta('400', 'No existen datos o parámetro incorrecto', null);
                    } else {
                        $this->genera_respuesta('200', 'Listado de Relación por estudio obtenido', $asig); 
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

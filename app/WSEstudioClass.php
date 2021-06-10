<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set('display_startup_errors', '1');

require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/libs/LibreriaClass.php';

/**
 * Description of WSEstudioClass
 *
 * @author musef2904@gmail.com
 */
class WSEstudioClass extends LibreriaClass {
    
    
   /**
    * WS consulta de estudio por id
    */
    public function consultarEstudio() {

        // solo se admiten get y/o post
        if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {


            $token = (isset($_REQUEST['__token'])) ? $_REQUEST['__token'] : "";

            if ($this->authorizedToken($token)) {

                if (isset($_REQUEST['id'])) {

                    $id = $this->filterNumber($_REQUEST['id']);
                    
                    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/EstudioDaoClass.php';
                    
                    $daoest = new EstudioDaoClass();
                    $est=$daoest->read($id);
                    
                    if (is_null($est) || $est===false) {
                        $this->genera_respuesta('400', 'No existen datos o parámetro incorrecto', null);
                    } else {
                        $this->genera_respuesta('200', 'Datos del Estudio obtenidos', $est);                        
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
     * WS consulta listado estudios
     */
    public function listarEstudios() {

        // solo se admiten get y/o post
        if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {


            $token = (isset($_REQUEST['__token'])) ? $_REQUEST['__token'] : "";

            if ($this->authorizedToken($token)) {

                if (isset($_REQUEST['list'])) {

                    
                    require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/EstudioDaoClass.php';
                    
                    $daoest = new EstudioDaoClass();
                    $est=$daoest->showlist();
                    
                    if (is_null($est) || $est===false) {
                        $this->genera_respuesta('400', 'No existen datos o parámetro incorrecto', null);
                    } else {
                        $this->genera_respuesta('200', 'Listado de Estudios obtenido', $est); 
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

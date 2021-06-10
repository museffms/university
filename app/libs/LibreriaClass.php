<?php

/**
 * Description of LibreriaClass
 *
 * @author musef2904@gmail.com
 */
class LibreriaClass {
    
    protected $_KEYTOKEN = "kD34TndHs89In3lOabnPj";
    
    /**
     * Esta función genera la respuesta web en formato JSON.
     * recibe los parámetros necesarios para la respuesta y devuelve
     * un objeto JSON como respuesta a la petición
     * 
     * @param type $status - requerido : 200 - 403 - 405 
     * @param type $message - requerido : breve frase de mensaje
     * @param type $data - requerido : null, array vacio o array con objetos JSON
     */
    protected function genera_respuesta($status, $message, $data) {
    
        header("Content-Type:application/json; charset=utf-8");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET,POST,PUT");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        
        header("HTTP/1.1 ".$status." ".$message);

        // status 200 - 403 - 405
        $response['status'] = $status;
        // mensaje de respuesta (OK, Error, KO, texto libre, etc)
        $response['message'] = $message;
        // data a devolver (array, array obs.JSON, null)
        $response['data'] = $data;
        
        // codificamos la respuesta
        $json_response = json_encode($response);
        // PUBLICAMOS el json
        echo $json_response;
    }
    
    
    /**
     * Esta función comprueba que el token recibido está autorizado o no
     * @param type $token
     * @return boolean
     */
    protected function authorizedToken($token) {
        
        if ($token === $this->_KEYTOKEN) {
            return true;
        }
        
        return false;
    }
    
    
    /**
     * Esta función filtra y sanitiza números enteros
     * @param type $numero
     * @return type
     */
    protected function filterNumber($numero) {

        $numero = preg_replace("/[^0-9]+/", "", $numero);
        
        return intval($numero);
    }
    
    /**
     * Admite letras, numeros, letras acentuadas, Ã± y una amplia variedad de signos
     * como son espacio - + * / _ , . ; : % Âª Âº ?
     * @param type $dataoriginal
     * @return type
     */
    protected function filterText($dataoriginal) {

        // permitidos        
        $result = preg_replace("/[^a-zA-Z0-9 ñÑçÇáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜ\']+/", "", $dataoriginal);    
        
        return $result;

    } 
    
    
}

<?php

/**
 * clase de conexion
 *
 * @author musef2904@gmail.com
 */
class ConnectionMysqlPDOClass {
	

    private $connexionPDO;
    private $dbhost= "localhost"; 
    private $dbuser= "USER"; 
    private $dbpass= "PASSWORD";    
    private $dbname= "university";

        
    function __construct (){
		
        // si no existe la conexión PDO la generamos
        if ( is_null($this->connexionPDO)) {
            $this->connexionPDO = $this->getConnection();
        }
        
    }


    
    /**
     * Esta función crea y devuelve un objeto de conexión con la DDBB
     * @return type
     */
    public function getConnection() {
        
        try {
            $this->connexionPDO= new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname.';charset=utf8', $this->dbuser, $this->dbpass
                    ,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",PDO::ATTR_PERSISTENT => true
            ));
            $this->connexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->connexionPDO =null;

        }
        return $this->connexionPDO;
        
    }
    



}


?>
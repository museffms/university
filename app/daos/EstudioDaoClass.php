<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/ConnectionMysqlPDOClass.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/models/EstudioClass.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/interfaces/interfaceEstudio.php';


/**
 * Description of EstudioDaoClass
 *
 * @author musef2904@gmail.com
 */
class EstudioDaoClass extends ConnectionMysqlPDOClass implements interfaceEstudio {
    
    // conexión
    private $connection;

    
    public function __construct() {
        
        // si no existe la conexión PDO la generamos
        if ( is_null($this->connection)) {
            
            $conn = new ConnectionMysqlPDOClass();
            
            $this->connection = $conn->getConnection();
        }

    }
    
    
    
    /**
     * Crea un estudio con los datos del nuevo objeto EstudioClass suministrado
     * @param EstudioClass $estudio
     * @return boolean || null resultado operación 
     */
    public function create(EstudioClass $estudio) {
        
        $result = false;
        try {
            $this->connection->beginTransaction();
            
            $nombreEstudio = $estudio->getNombre();
            
            $string = "INSERT INTO estudio (nombre) VALUES (:nombre)";
            $sql = $this->connection->prepare($string);                     
            
            $sql->bindParam(':nombre', $nombreEstudio); 
            
            $result=$sql->execute();
            
            $this->connection->commit();

        } catch (PDOException $e) {
            return null;
        }

        return $result;        
        
    }

    
    /**
     * Elimina un estudio en función del parámetro id suministrado
     * @param int $idEstudio
     * @return boolean || null resultado operación
     */
    public function delete(int $idEstudio) {
        
        $result = false;
        try {
            
            $this->connection->beginTransaction();
            
            $string = "DELETE FROM estudio WHERE id = :id LIMIT 1";
            $sql = $this->connection->prepare($string);                     
            
            $sql->bindParam(':id', $idEstudio, PDO::PARAM_INT); 
            
            $result=$sql->execute();
            
            $this->connection->commit();

        } catch (PDOException $e) {
            return null;
        }

        return $result;        
        
    }

    
    /**
     * Lee un estudio en función del parámetro id suministrado
     * @param int $idEstudio
     * @return \EstudioClass || false || null
     */
    public function read(int $idEstudio) {
        
        $estudio = false;
        
        try {            
            
            $string = "SELECT * FROM estudio WHERE id = :id";

            $sql = $this->connection->prepare($string);
            $sql->bindParam(':id',$idEstudio, PDO::PARAM_INT);
            $sql->execute();

            $res=$sql->setFetchMode(PDO::FETCH_CLASS,'EstudioClass');
            $result = $sql->fetch();
            
            if ($result !== false ) {
                $estudio = $result;    
            }            
            
        } catch (PDOException $e) {
            return null;
        }

        return $estudio;        
        
    }

    /**
     * Obtiene el listado de todos los estudioes
     * 
     * @return array con resultados || empty || null
     */
    public function showlist() {
        
        $listaEstudio = array();
        
        try {
            
            $string = "SELECT * FROM estudio LIMIT 1000";

            $sql = $this->connection->prepare($string);

            $sql->execute();
            
            $sql->setFetchMode(PDO::FETCH_CLASS,'EstudioClass');
            
            $results = $sql->fetchAll();

            if ($results !== false && count($results)>0) {
                $listaEstudio = $results;    
            }
            
            
        } catch (PDOException $e) {
            return null;
        }
        
        return $listaEstudio;         
        
    }

    
    /**
     * Actualiza un estudio con los datos del nuevo objeto EstudioClass suministrado
     * @param EstudioClass $estudio
     * @return boolean || null  resultado de la operación
     */
    public function update(EstudioClass $estudio) {
        
        $result = false;

        try {
            $this->connection->beginTransaction();
            
            $idEstudio = $estudio->getId();
            $nombreEstudio = $estudio->getNombre();
            
            $string = "UPDATE estudio SET nombre = :nombre WHERE id = :idEstudio";
            $sql = $this->connection->prepare($string);         
            
            $sql->bindParam(':idEstudio', $idEstudio, PDO::PARAM_INT);
            $sql->bindParam(':nombre', $nombreEstudio);
            
            $result=$sql->execute();

            $this->connection->commit();
            
        } catch (PDOException $e) {
            return null;
        }

        return $result;

    }

}

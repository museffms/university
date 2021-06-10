<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/ConnectionMysqlPDOClass.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/models/AsignaturaClass.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/interfaces/interfaceAsignatura.php';


/**
 * Description of AsignaturaDaoClass
 *
 * @author musef2904@gmail.com
 */
class AsignaturaDaoClass extends ConnectionMysqlPDOClass implements interfaceAsignatura {
    
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
     * Crea un asignatura con los datos del nuevo objeto AsignaturaClass suministrado
     * @param AsignaturaClass $asignatura
     * @return boolean || null resultado operación 
     */
    public function create(AsignaturaClass $asignatura) {
        
        $result = false;
        
        try {
            $this->connection->beginTransaction();
            
            $nombreAsignatura = $asignatura->getNombre();
            $idEstudio = $asignatura->getIdEstudio();
            
            $string = "INSERT INTO asignatura (nombre,id_estudio) VALUES (:nombre, :idestudio)";
            $sql = $this->connection->prepare($string);                     
            
            $sql->bindParam(':nombre', $nombreAsignatura); 
            $sql->bindParam(':idestudio', $idEstudio, PDO::PARAM_INT); 
            
            $result=$sql->execute();
            
            $this->connection->commit();

        } catch (PDOException $e) {
            return null;
        }

        return $result;        
        
    }

    
    /**
     * Lee un asignatura en función del parámetro id suministrado
     * @param int $idAsignatura
     * @return \AsignaturaClass || false || null
     */
    public function read(int $idAsignatura) {
        
        $asignatura = false;
        
        try {            
            
            $string = "SELECT * FROM asignatura WHERE id = :id";

            $sql = $this->connection->prepare($string);
            $sql->bindParam(':id',$idAsignatura, PDO::PARAM_INT);
            $sql->execute();

            $res=$sql->setFetchMode(PDO::FETCH_CLASS,'AsignaturaClass');
            $result = $sql->fetch();
            
            if ($result !== false ) {
                $asignatura = $result;    
            }            
            
        } catch (PDOException $e) {
            return null;
        }

        return $asignatura;        
        
    }    

    
    /**
     * Actualiza un asignatura con los datos del nuevo objeto AsignaturaClass suministrado
     * @param AsignaturaClass $asignatura
     * @return boolean || null  resultado de la operación
     */
    public function update(AsignaturaClass $asignatura) {
        
        $result = false;

        try {
            $this->connection->beginTransaction();
            
            $idAsignatura = $asignatura->getId();
            $nombreAsignatura = $asignatura->getNombre();
            $idEstudio = $asignatura->getIdEstudio();
            
            $string = "UPDATE asignatura SET nombre = :nombre, id_estudio = :idestudio WHERE id = :idAsignatura";
            $sql = $this->connection->prepare($string);         
            
            $sql->bindParam(':idAsignatura', $idAsignatura, PDO::PARAM_INT);
            $sql->bindParam(':nombre', $nombreAsignatura);
            $sql->bindParam(':idestudio', $idEstudio, PDO::PARAM_INT); 
            
            $result=$sql->execute();

            $this->connection->commit();
            
        } catch (PDOException $e) {
            return null;
        }

        return $result;

    }
           
    
    /**
     * Elimina un asignatura en función del parámetro id suministrado
     * @param int $idAsignatura
     * @return boolean || null resultado operación
     */
    public function delete(int $idAsignatura) {
        
        $result = false;
        
        try {
            
            $this->connection->beginTransaction();
            
            $string = "DELETE FROM asignatura WHERE id = :id LIMIT 1";
            $sql = $this->connection->prepare($string);                     
            
            $sql->bindParam(':id', $idAsignatura, PDO::PARAM_INT); 
            
            $result=$sql->execute();
            
            $this->connection->commit();

        } catch (PDOException $e) {
            return null;
        }

        return $result;        
        
    }


    /**
     * Obtiene el listado de todos los asignaturas
     * 
     * @return array con resultados || empty || null
     */
    public function showlist() {
        
        $listaAsignatura = array();
        
        try {
            
            $string = "SELECT * FROM asignatura LIMIT 1000";

            $sql = $this->connection->prepare($string);

            $sql->execute();
            
            $sql->setFetchMode(PDO::FETCH_CLASS,'AsignaturaClass');
            
            $results = $sql->fetchAll();

            if ($results !== false && count($results)>0) {
                $listaAsignatura = $results;    
            }
            
            
        } catch (PDOException $e) {
            return null;
        }
        
        return $listaAsignatura;         
        
    }
    
    
    /**
     * Obtiene el listado de todos los asignaturas de un estudio concreto
     * 
     * @return array con resultados || empty || null
     */
    public function showlistByEstudio(int $idEstudio) {
        
        $listaAsignatura = array();
        
        try {
            
            $string = "SELECT * FROM asignatura WHERE id_estudio = :idestudio LIMIT 1000";

            $sql = $this->connection->prepare($string);
            $sql->bindParam(':idestudio', $idEstudio, PDO::PARAM_INT); 

            $sql->execute();
            
            $sql->setFetchMode(PDO::FETCH_CLASS,'AsignaturaClass');
            
            $results = $sql->fetchAll();

            if ($results !== false && count($results)>0) {
                $listaAsignatura = $results;    
            }
            
            
        } catch (PDOException $e) {
            return null;
        }
        
        return $listaAsignatura;         
        
    }    

}

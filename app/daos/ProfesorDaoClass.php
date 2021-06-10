<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/ConnectionMysqlPDOClass.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/models/ProfesorClass.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/interfaces/interfaceProfesor.php';


/**
 * Description of ProfesorDaoClass
 *
 * @author musef2904@gmail.com
 */
class ProfesorDaoClass extends ConnectionMysqlPDOClass implements interfaceProfesor {
  
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
     * Crea un profesor con los datos del nuevo objeto ProfesorClass suministrado
     * @param ProfesorClass $profesor
     * @return boolean || null resultado operación 
     */
    public function create(ProfesorClass $profesor) {
        
        $result = false;
        try {
            $this->connection->beginTransaction();
            
            $nombreProfesor = $profesor->getNombre();
            
            $string = "INSERT INTO profesor (nombre) VALUES (:nombre)";
            $sql = $this->connection->prepare($string);                     
            
            $sql->bindParam(':nombre', $nombreProfesor); 
            
            $result=$sql->execute();
            
            $this->connection->commit();

        } catch (PDOException $e) {
            return null;
        }

        return $result;        
        
    }

    
    /**
     * Lee un profesor en función del parámetro id suministrado
     * @param int $idProfesor
     * @return \ProfesorClass || false || null
     */
    public function read(int $idProfesor) {
        
        $profesor = false;
        
        try {            
            
            $string = "SELECT * FROM profesor WHERE id = :id";

            $sql = $this->connection->prepare($string);
            $sql->bindParam(':id', $idProfesor, PDO::PARAM_INT);
            $sql->execute();

            $res=$sql->setFetchMode(PDO::FETCH_CLASS,'ProfesorClass');
            $result = $sql->fetch();
            
            if ($result !== false ) {
                $profesor = $result;    
            }            
            
        } catch (PDOException $e) {
            return null;
        }

        return $profesor;        
        
    }

    
    /**
     * Actualiza un profesor con los datos del nuevo objeto ProfesorClass suministrado
     * @param ProfesorClass $profesor
     * @return boolean || null  resultado de la operación
     */
    public function update(ProfesorClass $profesor) {
        
        $result = false;

        try {
            
            $idProfesor = $profesor->getId();
            $nombreProfesor = $profesor->getNombre();
            
            $string = "UPDATE profesor SET nombre = :nombre WHERE id = :idProfesor";
            $sql = $this->connection->prepare($string);         
            
            $sql->bindParam(':idProfesor', $idProfesor, PDO::PARAM_INT);
            $sql->bindParam(':nombre', $nombreProfesor);
            
            $result=$sql->execute();

            $this->connection->commit();
            
        } catch (PDOException $e) {
            return null;
        }

        return $result;

    }
    
    /**
     * Elimina un profesor en función del parámetro id suministrado
     * @param int $idProfesor
     * @return boolean || null resultado operación
     */
    public function delete(int $idProfesor) {
        
        $result = false;
        try {
            
            $this->connection->beginTransaction();
            
            $string = "DELETE FROM profesor WHERE id = :id LIMIT 1";
            $sql = $this->connection->prepare($string);                     
            
            $sql->bindParam(':id', $idProfesor, PDO::PARAM_INT); 
            
            $result=$sql->execute();
            
            $this->connection->commit();

        } catch (PDOException $e) {
            return null;
        }

        return $result;        
        
    }
    

    /**
     * Obtiene el listado de todos los profesores
     * 
     * @return array con resultados || empty || null
     */
    public function showlist() {
        
        $listaProfesores = array();
        
        try {
            
            $string = "SELECT * FROM profesor LIMIT 1000";

            $sql = $this->connection->prepare($string);

            $sql->execute();
            
            $sql->setFetchMode(PDO::FETCH_CLASS,'ProfesorClass');
            
            $results = $sql->fetchAll();

            if ($results !== false && count($results)>0) {
                $listaProfesores = $results;    
            }
            
            
        } catch (PDOException $e) {
            return null;
        }
        
        return $listaProfesores;         
        
    }    
    
    /**
     * Obtiene el listado de todos los profesores por nombre
     * 
     * @return array con resultados || empty || null
     */
    public function showlistByText(string $text) {
        
        $listaProfesores = array();
        
        try {
            
            $string = "SELECT * FROM profesor WHERE nombre LIKE CONCAT('%', :nombre, '%') LIMIT 1000";

            $sql = $this->connection->prepare($string);
            $sql->bindParam(':nombre', $text);

            $sql->execute();
            
            $sql->setFetchMode(PDO::FETCH_CLASS,'ProfesorClass');
            
            $results = $sql->fetchAll();

            if ($results !== false && count($results)>0) {
                $listaProfesores = $results;    
            }
            
            
        } catch (PDOException $e) {
            return null;
        }
        
        return $listaProfesores;         
        
    }     
    
}

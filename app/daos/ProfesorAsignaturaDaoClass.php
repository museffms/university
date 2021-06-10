<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/ConnectionMysqlPDOClass.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/models/ProfesorAsignaturaExtendedClass.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/models/ProfesorAsignaturaClass.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/university/app/daos/interfaces/interfaceProfesorAsignatura.php';


/**
 * Description of AsignaturaDaoClass
 *
 * @author musef2904@gmail.com
 */
class ProfesorAsignaturaDaoClass extends ConnectionMysqlPDOClass implements interfaceProfesorAsignatura {
    
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
     * Crea una relación profesor asignatura con los datos del nuevo objeto ProfesorAsignaturaClass suministrado
     * @param ProfesorAsignaturaClass $profAsignatura
     * @return boolean || null resultado operación 
     */
    public function create(ProfesorAsignaturaClass $profAsignatura) {
        
        $result = false;
        
        try {
            $this->connection->beginTransaction();
            
            $idAsignatura = $profAsignatura->getIdAsignatura();
            $idProfesor = $profAsignatura->getIdProfesor();
            
            $string = "INSERT INTO profesor_asignatura (id_profesor, id_asignatura) VALUES (:idprofesor, :idasignatura)";
            $sql = $this->connection->prepare($string);                     
             
            $sql->bindParam(':idprofesor', $idProfesor, PDO::PARAM_INT);             
            $sql->bindParam(':idasignatura', $idAsignatura, PDO::PARAM_INT); 
            
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
     * @return \ProfesorAsignaturaClass || false || null
     */
    public function read(int $idProfAsignatura) {
        
        $profAsignatura = false;
        
        try {            
            $string = "SELECT profesor_asignatura.*, profesor.nombre, asignatura.nombre as asignatura FROM profesor_asignatura ";
            $string .= " LEFT JOIN profesor ON profesor.id = profesor_asignatura.id_profesor ";
            $string .= " LEFT JOIN asignatura ON asignatura.id = profesor_asignatura.id_asignatura ";            
            $string .= " WHERE profesor_asignatura.id = :id ";

            $sql = $this->connection->prepare($string);
            $sql->bindParam(':id',$idProfAsignatura, PDO::PARAM_INT);
            $sql->execute();

            $res=$sql->setFetchMode(PDO::FETCH_CLASS,'ProfesorAsignaturaExtendedClass');
            $result = $sql->fetch();
            
            if ($result !== false ) {
                $profAsignatura = $result;    
            }            
            
        } catch (PDOException $e) {
            return null;
        }


        return $profAsignatura;        
        
    }    

    
    /**
     * Actualiza una relación profesor-asignatura con los datos del nuevo objeto ProfesorAsignaturaClass suministrado
     * @param ProfesorAsignaturaClass $profAsignatura
     * @return boolean || null  resultado de la operación
     */
    public function update(ProfesorAsignaturaClass $profAsignatura) {
        
        $result = false;
        
        try {
            
            $this->connection->beginTransaction();
            
            $idAsignatura = $profAsignatura->getIdAsignatura();
            $idProfesor = $profAsignatura->getIdProfesor();
            $id = $profAsignatura->getId();
            
            $string = "UPDATE profesor_asignatura SET id_profesor = :idprofesor, id_asignatura = :idasignatura WHERE id = :id";
            $sql = $this->connection->prepare($string);         
            
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->bindParam(':idasignatura', $idAsignatura, PDO::PARAM_INT);
            $sql->bindParam(':idprofesor', $idProfesor, PDO::PARAM_INT); 
            
            $result=$sql->execute();

            $this->connection->commit();
            
        } catch (PDOException $e) {
            return null;
        }
        
        return $result;

    }
           
    
    /**
     * Elimina una relación profesor-asignatura en función del parámetro id suministrado
     * @param int $idProfAsignatura
     * @return boolean || null resultado operación
     */
    public function delete(int $idProfAsignatura) {
        
        $result = false;
        
        try {
            
            $this->connection->beginTransaction();
            
            $string = "DELETE FROM profesor_asignatura WHERE id = :id LIMIT 1";
            $sql = $this->connection->prepare($string);                     
            
            $sql->bindParam(':id', $idProfAsignatura, PDO::PARAM_INT); 
            
            $result=$sql->execute();
            
            $this->connection->commit();

        } catch (PDOException $e) {
            return null;
        }

        return $result;        
        
    }


    /**
     * Obtiene el listado de todas los profesores y sus asignaturas
     * 
     * @return array con resultados || empty || null
     */
    public function showlist() {
        
        $listaAsignatura = array();
        
        try {
            
            $string = "SELECT profesor_asignatura.*, profesor.nombre, asignatura.nombre as asignatura FROM profesor_asignatura ";
            $string .= " LEFT JOIN profesor ON profesor.id = profesor_asignatura.id_profesor ";
            $string .= " LEFT JOIN asignatura ON asignatura.id = profesor_asignatura.id_asignatura ";
            $string .= " ORDER BY profesor_asignatura.id ASC ";

            $sql = $this->connection->prepare($string);

            $sql->execute();
            
            $sql->setFetchMode(PDO::FETCH_CLASS,'ProfesorAsignaturaExtendedClass');
            
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
     * Obtiene el listado de todos los profesores de una asignatura
     * 
     * @return array con resultados || empty || null
     */
    public function showlistByAsignatura(int $idAsignatura) {
        
        $listaAsignatura = array();
        
        try {
            
            $string = "SELECT profesor_asignatura.*, profesor.nombre, asignatura.nombre as asignatura FROM profesor_asignatura ";
            $string .= " LEFT JOIN profesor ON profesor.id = profesor_asignatura.id_profesor ";
            $string .= " LEFT JOIN asignatura ON asignatura.id = profesor_asignatura.id_asignatura ";
            $string .= " WHERE profesor_asignatura.id_asignatura = :idasignatura ";

            $sql = $this->connection->prepare($string);
            $sql->bindParam(':idasignatura', $idAsignatura, PDO::PARAM_INT);
            
            $sql->execute();
            
            $sql->setFetchMode(PDO::FETCH_CLASS,'ProfesorAsignaturaExtendedClass');
            
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
     * Obtiene el listado de todas las asignatura de un profesor
     * 
     * @return array con resultados || empty || null
     */
    public function showlistByProfesor(int $idProfesor) {
        
        $listaAsignatura = array();
        
        try {
            
            $string = "SELECT profesor_asignatura.*, profesor.nombre, asignatura.nombre as asignatura FROM profesor_asignatura ";
            $string .= " LEFT JOIN profesor ON profesor.id = profesor_asignatura.id_profesor ";
            $string .= " LEFT JOIN asignatura ON asignatura.id = profesor_asignatura.id_asignatura ";
            $string .= " WHERE profesor_asignatura.id_profesor = :idprofesor ";

            $sql = $this->connection->prepare($string);
            $sql->bindParam(':idprofesor', $idProfesor, PDO::PARAM_INT);
            
            $sql->execute();
            
            $sql->setFetchMode(PDO::FETCH_CLASS,'ProfesorAsignaturaExtendedClass');
            
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
     * Obtiene el listado de todas los profesores de un estudio
     * 
     * @return array con resultados || empty || null
     */
    public function showlistByEstudio(int $idEstudio) {
        
        $listaAsignatura = array();
        
        try {
            
            $string = "SELECT profesor_asignatura.*, profesor.nombre, asignatura.nombre as asignatura FROM profesor_asignatura ";
            $string .= " LEFT JOIN profesor ON profesor.id = profesor_asignatura.id_profesor ";
            $string .= " LEFT JOIN asignatura ON asignatura.id = profesor_asignatura.id_asignatura ";
            $string .= " LEFT JOIN estudio ON estudio.id = asignatura.id_estudio ";
            $string .= " WHERE estudio.id = :idestudio ";

            $sql = $this->connection->prepare($string);
            $sql->bindParam(':idestudio', $idEstudio, PDO::PARAM_INT);
            
            $sql->execute();
            
            $sql->setFetchMode(PDO::FETCH_CLASS,'ProfesorAsignaturaExtendedClass');
            
            $results = $sql->fetchAll();

            if ($results !== false && count($results)>0) {
                $listaAsignatura = $results;    
            }
            
            
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        
        return $listaAsignatura;         
        
    }     
}

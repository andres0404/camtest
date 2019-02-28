<?php
include_once 'controller.php';
include_once("../model/DAO_Cursos.php");
include_once("../model/DAO_Estudiantes.php");

class Estudiantes extends Controller{

    function __construct() {
        
    }
    /**
     * 
     * @return \self
     */
    public static function run(){
        return new self();
    }
    /**
     * Listar todos los elementos de la tabla estdiantes
     * @return type
     * @throws DAOException
     */
    public function listarEstudiantes($id_estudiante = null){
        $objEstudiantes = new DAO_Estudiantes();
        if(!empty($id_estudiante)){
            $objEstudiantes->set_id_estudiante($id_estudiante);
        }
        return $this->_listar($objEstudiantes);
    }
    
    /**
     * Listar todos los elementos de la tabla cursos
     * @return type
     * @throws DAOException
     */
    public function listarCursos($id_curso = null){
        $objCursos = new DAO_Cursos();
        if(!empty($id_curso)){
            $objCursos->set_id_curso($id_curso);
        }
        return $this->_listar($objCursos);
    }
    
    
    
    public function eliminarEstudiante($id){
        $_objEstudiantes = new DAO_Estudiantes();
        $_objEstudiantes->set_id_estudiante($id);
        $this->_eliminarRegistro($_objEstudiantes);
    }
    
    
}



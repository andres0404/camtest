<?php
include_once 'class.DAO.php'; 

class DAO_Estudiantes extends DAOGeneral {


    protected $_id_estudiante;
    protected $_id_curso;
    protected $_nombre;
    protected $_strCurso;


    protected $_tabla = 'estudiantes';
    protected $_mapa = [
        'id_estudiante' => ['tipodato' => 'integer'],
        'id_curso' => ['tipodato' => 'integer'],
        'strCurso' => ['tipodato' => 'varchar','sql' =>'(SELECT nombre_curso FROM cursos cs WHERE cs.id_curso = estudiantes.id_curso)'],
        'nombre' => ['tipodato' => 'varchar'],
        
    ];
    
    protected $_primario = 'id_estudiante';
    
    
    function get_id_estudiante() {
        return $this->_id_estudiante;
    }

    function get_id_curso() {
        return $this->_id_curso;
    }

    function get_nombre() {
        return $this->_nombre;
    }

    function set_id_estudiante($_id_estudiante) {
        $this->_id_estudiante = $_id_estudiante;
    }

    function set_id_curso($_id_curso) {
        $this->_id_curso = $_id_curso;
    }

    function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }
    function get_strCurso() {
        return $this->_strCurso;
    }

    function set_strCurso($_strCurso) {
        $this->_strCurso = $_strCurso;
    }




    
}
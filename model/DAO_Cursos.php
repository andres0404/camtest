<?php 
include_once 'class.DAO.php'; 

class DAO_Cursos extends DAOGeneral {


    protected $_id_curso;
    protected $_nombre_curso;
    
    protected $_tabla = 'cursos';
    protected $_mapa = [
        'id_curso' => ['tipodato' => 'integer'],
        'nombre_curso' => ['tipodato' => 'varchar']
    ];
    protected $_primario = 'id_curso';

    function get_id_curso() {
        return $this->_id_curso;
    }

    function get_nombre_curso() {
        return $this->_nombre_curso;
    }

    function set_id_curso($_id_curso) {
        $this->_id_curso = $_id_curso;
    }

    function set_nombre_curso($_nombre_curso) {
        $this->_nombre_curso = $_nombre_curso;
    }



    
}
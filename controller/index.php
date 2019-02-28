<?php
error_reporting(E_ALL);
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require 'estudiantes.php';

set_error_handler(function ($severity, $message, $file, $line) {
    if (error_reporting() & $severity) {
        throw new \ErrorException($message, 0, $severity, $file, $line);
    }
});
//header('Content-Type: application/json');
$app = new \Slim\App(['debug' => false]);
// ------------------------ CURSOS --------------------------------

$app->get('/api/cursos[/{id}]', function(Request $request, Response $response, $args) {
    try {
        $id = null;
        if(isset($args['id'])){
            $id = $args['id'];
        }
        $arrCursos = Estudiantes::run()->listarCursos($id);
        $response->withJson(["data" => $arrCursos],201);
    } catch (DAOException $ex) {
        $response->getBody()->write($ex->getMessage());
    }
    return $response;
});

$app->error(function(\Exception $e) use ($app) {
    $app->render('error.php');
});

//----------------------------- CLIENTES -------------------------------

$app->get('/api/estudiantes[/{id}]', function(Request $request, Response $response, $args) {
    try {
        $id = null;
        if(isset($args['id'])){
            $id = $args['id'];
        }
        $arrEstudiantes = Estudiantes::run()->listarEstudiantes($id);
        $response->withJson(["data" => $arrEstudiantes],201);
    } catch (DAOException $ex) {
        $response->getBody()->write($ex->getMessage());
    }
    return $response;
});
$app->post('/api/estudiantes', function(Request $request, Response $response){
    //$customer_id = $request->getParam("customer_id");
    $_objEstudiante = new DAO_Estudiantes();
    $arrMapa = $_objEstudiante->getMapa();
    foreach($arrMapa as $campo => $atributos){
        if($request->getParam($campo)){
            $_objEstudiante->{'set_'.$campo}($request->getParam($campo));
        }
    }
    if(!$_objEstudiante->guardar()){
        $response->withJson(['mensaje' => $_objEstudiante->get_sql_query()],500)->withHeader('Content-type', 'application/json');
        return $response;
    }
    $arrResponse = [
        'ok' => 1,
        'URL' => '/api/estudiantes/'.$_objEstudiante->get_id_estudiante(),
        'mensaje' => 'Estudiante ingresado'
    ];
    $response->withJson($arrResponse,201)->withHeader('Content-type', 'application/json');
    return $response;
});

$app->put('/api/estudiantes/{id}', function(Request $request, Response $response, $args){
    //$customer_id = $request->getParam("customer_id");
    if(!isset($args['id'])){
        $response->withJson(['mensaje' => 'No se establecio el estudiante a modificar'],304)->withHeader('Content-type', 'application/json');
        return $response;
    }
    $_objEstudiante = new DAO_Estudiantes();
    $arrMapa = $_objEstudiante->getMapa();
    foreach($arrMapa as $campo => $atributos){
        if($request->getParam($campo)){
            $_objEstudiante->{'set_'.$campo}($request->getParam($campo));
        }
    }
    $_objEstudiante->set_id_estudiante($args['id']);
    if(!$_objEstudiante->guardar()){
        $response->withJson(['mensaje' => $_objEstudiante->get_sql_error()],304)->withHeader('Content-type', 'application/json');
    }
    $arrResponse = [
        'ok' => 1,
        'URL' => '/api/estudiantes/'.$_objEstudiante->get_id_estudiante()
    ];
    $response->withJson($arrResponse,201)->withHeader('Content-type', 'application/json');
    return $response;
    
});

$app->delete('/api/estudiantes/{id}', function(Request $request, Response $response, $args){
    try{
        Estudiantes::run()->eliminarEstudiante($args['id']);
        $response->withJson(['mensaje' => "Estudiante {$args['id']} eliminado"],200)->withHeader('Content-type', 'application/json');
    } catch (DAOException $ex) {
        $response->withJson(['mensaje' => $ex->getMessage()],204)->withHeader('Content-type', 'application/json');
    }
    
});


$app->run();

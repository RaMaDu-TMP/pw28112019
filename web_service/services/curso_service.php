<?php
    include '../models/curso.php';
    include '../controllers/curso_controller.php';

    $response = array();
    
    try {
        if (isset($_GET['cmd'])) {
            $cmd = $_GET['cmd'];
    
            switch ($cmd) {
                case 'insert':
                    if (isset($_GET['nome'])) {
                        $curso = new Curso();
                        $curso->setNome($_GET['nome']);
    
                        CursoController::insert($curso);
    
                        $response['code'] = 1;
                        $response['message'] = 'Succes!';
                    } else {
                        throw new InvalidArgumentException("Command missing argument! Expected 'nome'");
                    }
                    break;
                
                case 'getAll':
                    $cursos = CursoController::getAll();
                    $response['data'] = array();
    
                    if (!is_null($cursos) && !empty($cursos)) {
                        foreach ($cursos as $p) {
                            $response['data'][] = $p->expose();
                        }
        
                        $response['code'] = 1;
                        $response['message'] = 'Succes!';
                    } else {
                        throw new InvalidArgumentException('Not found');
                    }
                    break;
    
                case 'getById':
                    if (isset($_GET['id'])) {
                        $curso = CursoController::getById($_GET['id']);
    
                        if (!is_null($curso) && !empty($curso)) {
                            $response['data'] = $curso->expose();
                            $response['code'] = 1;
                            $response['message'] = 'Succes!';
                        } else {
                            throw new InvalidArgumentException('Not found');
                        }
                    } else {
                        throw new InvalidArgumentException("Command missing argument! Expected 'id'");
                    }
                    break;
                
                case 'update':
                    if (isset($_GET['id']) && isset($_GET['nome'])) {
                        $curso = new Curso();
                        $curso->setId($_GET['id']);
                        $curso->setNome($_GET['nome']);
    
                        CursoController::update($curso);
    
                        $response['code'] = 1;
                        $response['message'] = 'Succes!';
                    } else {
                        throw new InvalidArgumentException("Command missing argument! Expected 'id' and 'name'");
                    }
                    break;
                
                case 'delete':
                    if (isset($_GET['id'])) {
                        CursoController::delete($_GET['id']);
    
                        $response['code'] = 1;
                        $response['message'] = 'Succes!';
                    } else {
                        throw new InvalidArgumentException("Command missing argument! Expected 'id'");
                    }
                    break;
                
                default:
                    throw new InvalidArgumentException("Invalid command! Current commands are: 'insert', 'getAll', 'getById', 'update' and 'delete'");
            }
        } else {
            throw new InvalidArgumentException("Empty command! Current commands are: 'insert', 'getAll', 'getById', 'update' and 'delete'");
        }
    } catch (Exception $e) {
        $response['code'] = $e->getCode();
        $response['message'] = $e->getMessage();
    }

    echo json_encode(($response));
?>
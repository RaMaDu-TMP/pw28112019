<?php
    include '../models/professor.php';
    include '../controllers/professor_controller.php';

    $response = array();
    
    try {
        if (isset($_GET['cmd'])) {
            $cmd = $_GET['cmd'];
    
            switch ($cmd) {
                case 'insert':
                    if (isset($_GET['nome'])) {
                        $professor = new Professor();
                        $professor->setNome($_GET['nome']);
    
                        ProfessorController::insert($professor);
    
                        $response['code'] = 1;
                        $response['message'] = 'Succes!';
                    } else {
                        throw new InvalidArgumentException("Command missing argument! Expected 'nome'");
                    }
                    break;
                
                case 'getAll':
                    $professores = ProfessorController::getAll();
                    $response['data'] = array();
    
                    if (!is_null($professores) && !empty($professores)) {
                        foreach ($professores as $p) {
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
                        $professor = ProfessorController::getById($_GET['id']);
    
                        if (!is_null($professor) && !empty($professor)) {
                            $response['data'] = $professor->expose();
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
                        $professor = new Professor();
                        $professor->setId($_GET['id']);
                        $professor->setNome($_GET['nome']);
    
                        ProfessorController::update($professor);
    
                        $response['code'] = 1;
                        $response['message'] = 'Succes!';
                    } else {
                        throw new InvalidArgumentException("Command missing argument! Expected 'id' and 'name'");
                    }
                    break;
                
                case 'delete':
                    if (isset($_GET['id'])) {
                        ProfessorController::delete($_GET['id']);
    
                        $response['code'] = 1;
                        $response['message'] = 'Succes!';
                    } else {
                        throw new InvalidArgumentException('Command missing argument!');
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
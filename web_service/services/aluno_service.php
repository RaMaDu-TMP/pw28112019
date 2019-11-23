<?php
    include '../models/aluno.php';
    include '../controllers/aluno_controller.php';

    $response = array();
    
    try {
        if (isset($_GET['cmd'])) {
            $cmd = $_GET['cmd'];
    
            switch ($cmd) {
                case 'insert':
                    if (isset($_GET['ra']) && isset($_GET['nome'])) {
                        $aluno = new Aluno();
                        $aluno->setRa($_GET['ra']);
                        $aluno->setNome($_GET['nome']);
    
                        AlunoController::insert($aluno);
    
                        $response['code'] = 1;
                        $response['message'] = 'Succes!';
                    } else {
                        throw new InvalidArgumentException("Command missing argument! Expected 'ra' and 'nome'");
                    }
                    break;
                
                case 'getAll':
                    $alunoes = AlunoController::getAll();
                    $response['data'] = array();
    
                    if (!is_null($alunoes) && !empty($alunoes)) {
                        foreach ($alunoes as $p) {
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
                        $aluno = AlunoController::getById($_GET['id']);
    
                        if (!is_null($aluno) && !empty($aluno)) {
                            $response['data'] = $aluno->expose();
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
                    if (isset($_GET['id']) && isset($_GET['ra']) && isset($_GET['nome'])) {
                        $aluno = new Aluno();
                        $aluno->setId($_GET['id']);
                        $aluno->setRa($_GET['ra']);
                        $aluno->setNome($_GET['nome']);
    
                        AlunoController::update($aluno);
    
                        $response['code'] = 1;
                        $response['message'] = 'Succes!';
                    } else {
                        throw new InvalidArgumentException("Command missing argument! Expected 'id' and 'name'");
                    }
                    break;
                
                case 'delete':
                    if (isset($_GET['id'])) {
                        AlunoController::delete($_GET['id']);
    
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
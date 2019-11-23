<?php
    include '../models/projeto.php';
    include '../controllers/projeto_controller.php';

    $response = array();
    
    try {
        if (isset($_GET['cmd'])) {
            $cmd = $_GET['cmd'];
    
            switch ($cmd) {
                case 'insert':
                    if (isset($_GET['nome'])) {
                        $projeto = new Projeto();
                        $projeto->setNome($_GET['nome']);
    
                        ProjetoController::insert($projeto);
    
                        $response['code'] = 1;
                        $response['message'] = 'Succes!';
                    } else {
                        throw new InvalidArgumentException("Command missing argument! Expected 'nome'");
                    }
                    break;
                
                case 'getAll':
                    $projetos = ProjetoController::getAll();
                    $response['data'] = array();
    
                    if (!is_null($projetos) && !empty($projetos)) {
                        foreach ($projetos as $p) {
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
                        $projeto = ProjetoController::getById($_GET['id']);
    
                        if (!is_null($projeto) && !empty($projeto)) {
                            $response['data'] = $projeto->expose();
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
                        $projeto = new Projeto();
                        $projeto->setId($_GET['id']);
                        $projeto->setNome($_GET['nome']);
    
                        ProjetoController::update($projeto);
    
                        $response['code'] = 1;
                        $response['message'] = 'Succes!';
                    } else {
                        throw new InvalidArgumentException("Command missing argument! Expected 'id' and 'name'");
                    }
                    break;
                
                case 'delete':
                    if (isset($_GET['id'])) {
                        ProjetoController::delete($_GET['id']);
    
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
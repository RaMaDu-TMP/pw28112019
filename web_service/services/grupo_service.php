<?php
    include '../models/grupo.php';
    include '../controllers/grupo_controller.php';

    $response = array();
    
    try {
        if (isset($_GET['cmd'])) {
            $cmd = $_GET['cmd'];
    
            switch ($cmd) {
                case 'insert':
                    if (isset($_GET['disciplina_id']) && isset($_GET['aluno_id']) && isset($_GET['projeto_id'])) {
                        $grupo = new Grupo();
                        $grupo->setDisciplina($_GET['disciplina_id']);
                        $grupo->setAluno($_GET['aluno_id']);
                        $grupo->setProjeto($_GET['projeto_id']);
    
                        GrupoController::insert($grupo);
    
                        $response['code'] = 1;
                        $response['message'] = 'Succes!';
                    } else {
                        throw new InvalidArgumentException("Command missing argument! Expected 'disciplina_id', 'aluno_id' and 'projeto_id'");
                    }
                    break;
                
                case 'getAll':
                $grupos = GrupoController::getAll();
                    $response['data'] = array();
    
                    if (!is_null($grupos) && !empty($grupos)) {
                        foreach ($grupos as $p) {
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
                        $grupo = GrupoController::getById($_GET['id']);
    
                        if (!is_null($grupo) && !empty($grupo)) {
                            $response['data'] = $grupo->expose();
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
                    if (isset($_GET['id']) && isset($_GET['disciplina_id']) && isset($_GET['aluno_id']) && isset($_GET['projeto_id'])) {
                        $grupo = new Grupo();
                        $grupo->setId($_GET['id']);
                        $grupo->setDisciplina($_GET['disciplina_id']);
                        $grupo->setAluno($_GET['aluno_id']);
                        $grupo->setProjeto($_GET['projeto_id']);
    
                        GrupoController::update($grupo);
    
                        $response['code'] = 1;
                        $response['message'] = 'Succes!';
                    } else {
                        throw new InvalidArgumentException("Command missing argument! Expected 'id', 'disciplina_id', 'aluno_id' and 'projeto_id'");
                    }
                    break;
                
                case 'delete':
                    if (isset($_GET['id'])) {
                        GrupoController::delete($_GET['id']);
    
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
<?php
    include '../models/disciplina.php';
    include '../controllers/disciplina_controller.php';

    $response = array();
    
    try {
        if (isset($_GET['cmd'])) {
            $cmd = $_GET['cmd'];
    
            switch ($cmd) {
                case 'insert':
                    if (isset($_GET['nome']) && isset($_GET['turno']) && isset($_GET['dia_semana']) && isset($_GET['curso_id']) && isset($_GET['professor_id'])) {
                        $disciplina = new Disciplina();
                        $disciplina->setNome($_GET['nome']);
                        $disciplina->setTurno($_GET['turno']);
                        $disciplina->setDiaSemana($_GET['dia_semana']);
                        $disciplina->setCurso($_GET['curso_id']);
                        $disciplina->setProfessor($_GET['professor_id']);
    
                        DisciplinaController::insert($disciplina);
    
                        $response['code'] = 1;
                        $response['message'] = 'Succes!';
                    } else {
                        throw new InvalidArgumentException("Command missing argument! Expected 'nome', 'turno', 'dia_semana', 'curso_id' and 'professor_id'");
                    }
                    break;
                
                case 'getAll':
                    $disciplinas = DisciplinaController::getAll();
                    $response['data'] = array();
    
                    if (!is_null($disciplinas) && !empty($disciplinas)) {
                        foreach ($disciplinas as $p) {
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
                        $disciplina = DisciplinaController::getById($_GET['id']);
    
                        if (!is_null($disciplina) && !empty($disciplina)) {
                            $response['data'] = $disciplina->expose();
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
                    if (isset($_GET['id']) && isset($_GET['nome']) && isset($_GET['turno']) && isset($_GET['dia_semana']) && isset($_GET['curso_id']) && isset($_GET['professor_id'])) {
                        $disciplina = new Disciplina();
                        $disciplina->setId($_GET['id']);
                        $disciplina->setNome($_GET['nome']);
                        $disciplina->setTurno($_GET['turno']);
                        $disciplina->setDiaSemana($_GET['dia_semana']);
                        $disciplina->setCurso($_GET['curso_id']);
                        $disciplina->setProfessor($_GET['professor_id']);
    
                        DisciplinaController::update($disciplina);
    
                        $response['code'] = 1;
                        $response['message'] = 'Succes!';
                    } else {
                        throw new InvalidArgumentException("Command missing argument! Expected 'id', 'name', 'turno', 'dia_semana', 'curso_id' and 'professor_id'");
                    }
                    break;
                
                case 'delete':
                    if (isset($_GET['id'])) {
                        DisciplinaController::delete($_GET['id']);
    
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
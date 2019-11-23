<?php
    require_once '../models/grupo.php';

    class GrupoController {
        
        public static function insert($grupo) {
            if (is_null($grupo->getDisciplina())) {
                throw new InvalidArgumentException("Disciplina can't be null");
            }
            if (is_null($grupo->getAluno())) {
                throw new InvalidArgumentException("Aluno can't be null");
            }
            if (is_null($grupo->getProjeto())) {
                throw new InvalidArgumentException("Projeto can't be null");
            }

            require_once 'database.php';
            $conn = Database::connection();

            $stm = $conn->prepare('INSERT INTO grupos(disciplina_id, aluno_id, projeto_id) VALUES(:disciplina_id, :aluno_id, :projeto_id)');

            $stm->bindValue(":disciplina_id", $grupo->getDisciplina()->getId());
            $stm->bindValue(":aluno_id", $grupo->getAluno()->getId());
            $stm->bindValue(":projeto_id", $grupo->getProjeto()->getId());
            $stm->execute();
        }

        public static function getAll() {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('SELECT * FROM grupos');
            $stm->execute();

            $result = $stm->fetchAll();

            $ret = array();
            foreach ($result as $r) {
                $grupo = Grupo::fromPDO($r);
                $ret[] = $grupo;
            }

            return $ret;
        }

        public static function getById($id) {
            require_once 'database.php';
            $conn = Database::connection();

            $stm = $conn->prepare('SELECT * FROM grupos WHERE id = :id');
            $stm->bindValue(":id", $id);
            $stm->execute();

            $result = $stm->fetchAll();
            if (is_null($result) || empty($result)) {
                return NULL;
            }
            return Grupo::fromPDO($result[0]);
        }

        public static function update($grupo) {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('UPDATE grupos '.
                                    'SET disciplina_id = :disciplina_id, aluno_id = :aluno_id, projeto_id = :projeto_id '.
                                    'WHERE id = :id');

            $stm->bindValue(":disciplina_id", $grupo->getDisciplina()->getId());
            $stm->bindValue(":aluno_id", $grupo->getAluno()->getId());
            $stm->bindValue(":projeto_id", $grupo->getProjeto()->getId());

            $stm->bindValue(":id", $grupo->getId());
            $stm->execute();
        }

        public static function delete($id) {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('DELETE FROM grupos WHERE id = :id');
            $stm->bindValue(":id", $id);
            $stm->execute();
        }
    }
?> 
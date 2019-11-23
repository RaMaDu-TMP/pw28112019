<?php
    require_once '../models/disciplina.php';

    class DisciplinaController {
        
        public static function insert($disciplina) {
            require_once 'database.php';
            $conn = Database::connection();

            $stm = $conn->prepare('INSERT INTO disciplinas(nome, turno, dia_semana, curso_id, professor_id) '.
                                    'VALUES(:nome, :turno, :dia_semana, :curso_id, :professor_id)');

            $stm->bindValue(":nome", $disciplina->getNome());
            $stm->bindValue(":turno", $disciplina->getTurno());
            $stm->bindValue(":dia_semana", $disciplina->getDiaSemana());
            $stm->bindValue(":curso_id", $disciplina->getCurso()->getId());
            $stm->bindValue(":professor_id", $disciplina->getProfessor()->getId());
            $stm->execute();
        }

        public static function getAll() {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('SELECT * FROM disciplinas');
            $stm->execute();

            $result = $stm->fetchAll();

            $ret = array();
            foreach ($result as $r) {
                $disciplina = Disciplina::fromPDO($r);
                $ret[] = $disciplina;
            }

            return $ret;
        }

        public static function getById($id) {
            require_once 'database.php';
            $conn = Database::connection();

            $stm = $conn->prepare('SELECT * FROM disciplinas WHERE id = :id');
            $stm->bindValue(":id", $id);
            $stm->execute();

            $result = $stm->fetchAll();
            if (is_null($result) || empty($result)) {
                return NULL;
            }
            return Disciplina::fromPDO($result[0]);
        }

        public static function update($disciplina) {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('UPDATE disciplinas '.
                                    'SET nome = :nome, turno = :turno, dia_semana = :dia_semana, curso_id = :curso_id, professor_id = :professor_id '.
                                    'WHERE id = :id');

            $stm->bindValue(":nome", $disciplina->getNome());
            $stm->bindValue(":turno", $disciplina->getTurno());
            $stm->bindValue(":dia_semana", $disciplina->getDiaSemana());
            $stm->bindValue(":curso_id", $disciplina->getCurso()->getId());
            $stm->bindValue(":professor_id", $disciplina->getProfessor()->getId());

            $stm->bindValue(":id", $disciplina->getId());
            $stm->execute();
        }

        public static function delete($id) {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('DELETE FROM disciplinas WHERE id = :id');
            $stm->bindValue(":id", $id);
            $stm->execute();
        }
    }
?> 
<?php
    class AlunoController {
        
        public static function insert($aluno) {
            require_once 'database.php';
            $conn = Database::connection();

            $stm = $conn->prepare('INSERT INTO alunos(ra, nome) VALUES(:ra, :nome)');

            $stm->bindValue(":ra", $aluno->getRa());
            $stm->bindValue(":nome", $aluno->getNome());
            $stm->execute();
        }

        public static function getAll() {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('SELECT * FROM alunos');
            $stm->execute();

            $result = $stm->fetchAll();

            $ret = array();
            foreach ($result as $r) {
                $aluno = Aluno::fromPDO($r);
                $ret[] = $aluno;
            }

            return $ret;
        }

        public static function getById($id) {
            require_once 'database.php';
            $conn = Database::connection();

            $stm = $conn->prepare('SELECT * FROM alunos WHERE id = :id');
            $stm->bindValue(":id", $id);
            $stm->execute();

            $result = $stm->fetchAll();
            if (is_null($result) || empty($result)) {
                return NULL;
            }
            return Aluno::fromPDO($result[0]);
        }

        public static function update($aluno) {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('UPDATE alunos SET ra = :ra, nome = :nome WHERE id = :id');

            $stm->bindValue(":ra", $aluno->getRa());
            $stm->bindValue(":nome", $aluno->getNome());

            $stm->bindValue(":id", $aluno->getId());
            $stm->execute();
        }

        public static function delete($id) {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('DELETE FROM alunos WHERE id = :id');
            $stm->bindValue(":id", $id);
            $stm->execute();
        }
    }
?> 
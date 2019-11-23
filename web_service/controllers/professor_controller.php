<?php
    include '../models/professor.php';

    class ProfessorController {
        
        public static function insert($professor) {
            require_once 'database.php';
            $conn = Database::connection();

            $stm = $conn->prepare('INSERT INTO professores(nome) VALUES(:nome)');

            $stm->bindValue(":nome", $professor->getNome());
            $stm->execute();
        }

        public static function getAll() {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('SELECT * FROM professores');
            $stm->execute();

            $result = $stm->fetchAll();

            $ret = array();
            foreach ($result as $r) {
                $professor = Professor::fromPDO($r);
                $ret[] = $professor;
            }

            return $ret;
        }

        public static function getById($id) {
            require_once 'database.php';
            $conn = Database::connection();

            $stm = $conn->prepare('SELECT * FROM professores WHERE id = :id');
            $stm->bindValue(":id", $id);
            $stm->execute();

            $result = $stm->fetchAll();
            if (is_null($result) || empty($result)) {
                return NULL;
            }
            return Professor::fromPDO($result[0]);
        }

        public static function update($professor) {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('UPDATE professores SET nome = :nome WHERE id = :id');

            $stm->bindValue(":nome", $professor->getNome());

            $stm->bindValue(":id", $professor->getId());
            $stm->execute();
        }

        public static function delete($id) {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('DELETE FROM professores WHERE id = :id');
            $stm->bindValue(":id", $id);
            $stm->execute();
        }
    }
?> 
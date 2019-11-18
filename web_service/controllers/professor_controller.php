<?php
    class ProfessorController {
        
        public static function insert($func) {
            require_once 'database.php';
            $conn = Database::connection();

            $stm = $conn->prepare('INSERT INTO professores(nome) VALUES(:nome)');

            $stm->bindValue(":nome", $func->getNome());
            $stm->execute();
        }

        public static function getAll() {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('SELECT * FROM professores');
            $stm->execute();

            $result = $stm->fetchAll();
            return $result;
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
            return $result[0];
        }

        public static function update($func) {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('UPDATE professores SET nome = :nome WHERE id = :id');

            $stm->bindValue(":nome", $func->getNome());

            $stm->bindValue(":id", $func->getId());
            $stm->execute();
        }

        public static function delete($func) {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('DELETE FROM professores WHERE id = :id');
            $stm->bindValue(":id", $func->getId());
            $stm->execute();
        }
    }
?> 
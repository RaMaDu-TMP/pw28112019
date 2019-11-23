<?php
    class ProfessorController {
        
        public static function insert($prof) {
            require_once 'database.php';
            $conn = Database::connection();

            $stm = $conn->prepare('INSERT INTO professores(nome) VALUES(:nome)');

            $stm->bindValue(":nome", $prof->getNome());
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
                $prof = Professor::fromPDO($r);
                $ret[]=$prof;
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

        public static function update($prof) {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('UPDATE professores SET nome = :nome WHERE id = :id');

            $stm->bindValue(":nome", $prof->getNome());

            $stm->bindValue(":id", $prof->getId());
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
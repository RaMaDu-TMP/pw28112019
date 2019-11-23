<?php
    class CursoController {
        
        public static function insert($curso) {
            require_once 'database.php';
            $conn = Database::connection();

            $stm = $conn->prepare('INSERT INTO cursos(nome) VALUES(:nome)');

            $stm->bindValue(":nome", $curso->getNome());
            $stm->execute();
        }

        public static function getAll() {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('SELECT * FROM cursos');
            $stm->execute();

            $result = $stm->fetchAll();
            
            $ret = array();
            foreach ($result as $r) {
                $curso = Curso::fromPDO($r);
                $ret[] = $curso;
            }

            return $ret;
        }

        public static function getById($id) {
            require_once 'database.php';
            $conn = Database::connection();

            $stm = $conn->prepare('SELECT * FROM cursos WHERE id = :id');
            $stm->bindValue(":id", $id);
            $stm->execute();

            $result = $stm->fetchAll();
            if (is_null($result) || empty($result)) {
                return NULL;
            }
            return Curso::fromPDO($result[0]);
        }

        public static function update($curso) {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('UPDATE cursos SET nome = :nome WHERE id = :id');

            $stm->bindValue(":nome", $curso->getNome());

            $stm->bindValue(":id", $curso->getId());
            $stm->execute();
        }

        public static function delete($id) {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('DELETE FROM cursos WHERE id = :id');
            $stm->bindValue(":id", $id);
            $stm->execute();
        }
    }
?> 
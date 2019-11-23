<?php
    class ProjetoController {
        
        public static function insert($projeto) {
            require_once 'database.php';
            $conn = Database::connection();

            $stm = $conn->prepare('INSERT INTO projetos(nome) VALUES(:nome)');

            $stm->bindValue(":nome", $projeto->getNome());
            $stm->execute();
        }

        public static function getAll() {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('SELECT * FROM projetos');
            $stm->execute();

            $result = $stm->fetchAll();
            
            $ret = array();
            foreach ($result as $r) {
                $projeto = Projeto::fromPDO($r);
                $ret[] = $projeto;
            }

            return $ret;
        }

        public static function getById($id) {
            require_once 'database.php';
            $conn = Database::connection();

            $stm = $conn->prepare('SELECT * FROM projetos WHERE id = :id');
            $stm->bindValue(":id", $id);
            $stm->execute();

            $result = $stm->fetchAll();
            if (is_null($result) || empty($result)) {
                return NULL;
            }
            return Projeto::fromPDO($result[0]);
        }

        public static function update($projeto) {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('UPDATE projetos SET nome = :nome WHERE id = :id');

            $stm->bindValue(":nome", $projeto->getNome());

            $stm->bindValue(":id", $projeto->getId());
            $stm->execute();
        }

        public static function delete($projeto) {
            require_once 'database.php';
            $conn = Database::connection();
            
            $stm = $conn->prepare('DELETE FROM projetos WHERE id = :id');
            $stm->bindValue(":id", $projeto);
            $stm->execute();
        }
    }
?> 
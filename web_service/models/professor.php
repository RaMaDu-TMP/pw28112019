<?php
    include 'exposable.php';

    class Professor implements Exposable {

        private $id;
        private $nome;
        
        function __contruct($id, $nome) {
            setId($id);
            setNome($nome);
        }
        
        function getId() {
            return $this->id;
        }
        
        function setId($id) {
            $this->id = $id;
        }
        
        function getNome() {
            return $this->nome;
        }
        
        function setNome($nome) {
            $this->nome = $nome;
        }

        function expose() {
            return get_object_vars($this);
        }

        function printInfo() {
            echo '<br>---------------[PROFESSOR]---------------';
            echo '<br>ID: '.$this->getId();
            echo '<br>Nome: '.$this->getNome();
            echo '<br>';
        }
        
        public static function fromPDO($fPDO) {
            $teacher = new Professor();
            $teacher->setId($fPDO['id']);
            $teacher->setNome($fPDO['nome']);
        
            return $teacher;
        }
    }
?>
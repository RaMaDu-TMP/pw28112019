<?php
    class Curso {

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
        
        function printInfo() {
            echo '<br>---------------[CURSO]---------------';
            echo '<br>ID: '.$this->getId();
            echo '<br>Nome: '.$this->getNome();
            echo '<br>';
        }
        
        public static function fromPDO($fPDO) {
            $class = new Curso();
            $class->setId($fPDO['id']);
            $class->setNome($fPDO['nome']);
        
            return $class;
        }
    }
?>
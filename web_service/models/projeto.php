<?php
    require_once 'exposable.php';

    class Projeto implements Exposable {

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
            echo '<br>---------------[PROJETO]---------------';
            echo '<br>ID: '.$this->getId();
            echo '<br>Nome

        function expose() {
            return get_object_vars($this);
        }: '.$this->getNome();
            echo '<br>';
        }
        
        public static function fromPDO($fPDO) {
            $project = new Projeto();
            $project->setId($fPDO['id']);
            $project->setNome($fPDO['nome']);
        
            return $project;
        }
    }
?>
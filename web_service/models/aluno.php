<?php
    require_once 'exposable.php';

    class Aluno implements Exposable {

        private $id;
        private $ra;
        private $nome;
        
        function __contruct($id, $ra, $nome) {
            setId($id);
            setRa($ra);
            setNome($nome);
        }
        
        function getId() {
            return $this->id;
        }
        
        function setId($id) {
            $this->id = $id;
        }
        
        function getRa() {
            return $this->ra;
        }

        function setRa($ra) {
            $this->ra = $ra;
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
            echo '<br>---------------[ALUNO]---------------';
            echo '<br>ID: '.$this->getId();
            echo '<br>RA: '.$this->getRa();
            echo '<br>Nome: '.$this->getNome();
            echo '<br>';
        }
        
        public static function fromPDO($fPDO) {
            $student = new Aluno();
            $student->setId($fPDO['id']);
            $student->setRa($fPDO['ra']);
            $student->setNome($fPDO['nome']);
        
            return $student;
        }
    }
?>
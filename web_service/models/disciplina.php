<?php
    include 'exposable.php';

    class Disciplina implements Exposable {

        private $id;
        private $nome;
        private $turno;
        private $diaSemana;
        private $curso;
        private $professor;
        
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

        function getTurno() {
            return $this->turno;
        }
        
        function setTurno($turno) {
            $this->turno = $turno;
        }
        function getDiaSemana() {
            return $this->diaSemana;
        }
        
        function setDiaSemana($diaSemana) {
            $this->diaSemana = $diaSemana;
        }

        function getCurso() {
            return $this->curso;
        }
        
        function setCurso($curso) {
            $this->curso = $curso;
        }

        function getProfessor() {
            return $this->professor;
        }
        
        function setProfessor($professor) {
            $this->professor = $professor;
        }

        function expose() {
            return get_object_vars($this);
        }
        
        function printInfo() {
            echo '<br>---------------[DISCIPLINA]---------------';
            echo '<br>ID: '.$this->getId();
            echo '<br>Nome: '.$this->getNome();
            echo '<br>Turno: '.$this->getTurno();
            echo '<br>DiaSemana: '.$this->getDiaSemana();
            echo '<br>Curso: '.$this->getCurso();
            echo '<br>Professor: '.$this->getProfessor();
            echo '<br>';
        }
        
        public static function fromPDO($fPDO) {
            $discipline = new Disciplina();
            $discipline->setId($fPDO['id']);
            $discipline->setNome($fPDO['nome']);
            $discipline->setTurno($fPDO['turno']);
            $discipline->setDiaSemana($fPDO['dia_semana']);

            require_once '../controllers/curso_controller.php';
            $discipline->setCurso(CursoController::getById($fPDO['curso_id']));

            require_once '../controllers/professor_controller.php';
            $discipline->setProfessor(ProfessorController::getById($fPDO['professor_id']));
        
            return $discipline;
        }
    }
?>
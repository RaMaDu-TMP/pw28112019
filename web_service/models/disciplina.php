<?php
    require_once 'exposable.php';

    require_once '../controllers/curso_controller.php';
    require_once '../controllers/professor_controller.php';

    require_once '../enum/TURNO.php';
    require_once '../enum/DIA_SEMANA.php';

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
            if (!TURNO::validEnum($turno)) {
                throw new InvalidArgumentException("'".$turno."' is not a valid TURNO enum! Current valid values: ".implode(", ", TURNO::values()));
            }
            
            $this->turno = $turno;
        }
        function getDiaSemana() {
            return $this->diaSemana;
        }
        
        function setDiaSemana($diaSemana) {
            if (!DIA_SEMANA::validEnum($diaSemana)) {
                throw new InvalidArgumentException("'".$diaSemana."' is not a valid DIA_SEMANA enum! Current valid values: ".implode(", ", DIA_SEMANA::values()));
            }

            $this->diaSemana = $diaSemana;
        }

        function getCurso() {
            return $this->curso;
        }
        
        function setCurso($curso) {
            if (is_numeric($curso)) {
                $curso = CursoController::getById($curso);
            }

            if ($curso instanceof Curso) {
                $this->curso = $curso;
            } else {
                throw new InvalidArgumentException("'".$curso."' is not a valid Curso instance");
            }
        }

        function getProfessor() {
            return $this->professor;
        }
        
        function setProfessor($professor) {
            if (is_numeric($professor)) {
                $professor = ProfessorController::getById($professor);
            }

            if ($professor instanceof Professor) {
                $this->professor = $professor;
            } else {
                throw new InvalidArgumentException("'".$professor."' is not a valid Professor instance");
            }
        }

        function expose() {
            $vars = get_object_vars($this);
            $vars['curso'] = $this->curso->expose();
            $vars['professor'] = $this->professor->expose();

            return $vars;
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

            $discipline->setCurso(CursoController::getById($fPDO['curso_id']));
            $discipline->setProfessor(ProfessorController::getById($fPDO['professor_id']));
        
            return $discipline;
        }
    }
?>
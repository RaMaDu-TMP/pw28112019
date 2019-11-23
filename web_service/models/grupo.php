<?php
    require_once 'exposable.php';

    include '../controllers/aluno_controller.php';
    include '../controllers/projeto_controller.php';
    include '../controllers/disciplina_controller.php';

    class Grupo implements Exposable {

        private $id;
        private $disciplina;
        private $aluno;
        private $projeto;
        
        function __contruct($id, $disciplina) {
            setId($id);
            setDisciplina($disciplina);
        }
        
        function getId() {
            return $this->id;
        }
        
        function setId($id) {
            $this->id = $id;
        }
        
        function getDisciplina() {
            return $this->disciplina;
        }
        
        function setDisciplina($disciplina) {
            if (is_numeric($disciplina)) {
                $disciplina = DisciplinaController::getById($disciplina);
            }

            if ($disciplina instanceof Disciplina) {
                $this->disciplina = $disciplina;
            } else {
                throw new InvalidArgumentException("'".$disciplina."' is not a valid Disciplina instance");
            }
        }
        
        function getAluno() {
            return $this->aluno;
        }
        
        function setAluno($aluno) {
            if (is_numeric($aluno)) {
                $aluno = AlunoController::getById($aluno);
            }

            if ($aluno instanceof Aluno) {
                $this->aluno = $aluno;
            } else {
                throw new InvalidArgumentException("'".$aluno."' is not a valid Aluno instance");
            }
        }
        
        function getProjeto() {
            return $this->projeto;
        }
        
        function setProjeto($projeto) {
            if (is_numeric($projeto)) {
                $projeto = ProjetoController::getById($projeto);
            }

            if ($projeto instanceof Projeto) {
                $this->projeto = $projeto;
            } else {
                throw new InvalidArgumentException("'".$projeto."' is not a valid Projeto instance");
            }
        }

        function expose() {
            $vars = get_object_vars($this);
            $vars['aluno'] = $this->aluno->expose();
            $vars['projeto'] = $this->projeto->expose();

            return $vars;
        }

        function printInfo() {
            echo '<br>---------------[GRUPO]---------------';
            echo '<br>ID: '.$this->getId();
            echo '<br>Disciplina: '.$this->getDisciplina();
            echo '<br>Aluno: '.$this->getAluno();
            echo '<br>Projeto: '.$this->getProjeto();
            echo '<br>';
        }
        
        public static function fromPDO($fPDO) {
            $group = new Grupo();
            $group->setId($fPDO['id']);
            
            $group->setDisciplina(DisciplinaController::getById($fPDO['disciplina_id']));
            $group->setAluno(AlunoController::getById($fPDO['aluno_id']));
            $group->setProjeto(ProjetoController::getById($fPDO['projeto_id']));
        
            return $group;
        }
    }
?>
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

            $this->disciplina = $disciplina;
        }
        
        function getAluno() {
            return $this->aluno;
        }
        
        function setAluno($aluno) {
            if (is_numeric($aluno)) {
                $aluno = AlunoController::getById($aluno);
            }

            $this->aluno = $aluno;
        }
        
        function getProjeto() {
            return $this->projeto;
        }
        
        function setProjeto($projeto) {
            if (is_numeric($projeto)) {
                echo "YEEEEO";
                $projeto = ProjetoController::getById($projeto);
            }

            $this->projeto = $projeto;
        }
        
        function printInfo() {
            echo '<br>---------------[GRUPO]---------------';
            echo '<br>ID: '.$this->getId();
            echo '<br>Disciplina: '.$this->getDisciplina();
            echo '<br>Aluno: '.$this->getAluno();
            echo '<br>Projeto: '.$this->getProjeto();
            echo '<br>';
        }

        function expose() {
            return get_object_vars($this);
        }
        
        public static function fromPDO($fPDO) {
            $group = new Grupo();
            $group->setId($fPDO['id']);

            $group->setDisciplina(DisciplinaController::getById($fPDO['disciplina']));
            $group->setDisciplina(AlunoController::getById($fPDO['aluno_id']));

            $group->setDisciplina(ProjetoController::getById($fPDO['projeto_id']));
        
            return $group;
        }
    }
?>
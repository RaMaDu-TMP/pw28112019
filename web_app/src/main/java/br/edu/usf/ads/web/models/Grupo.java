package br.edu.usf.ads.web.models;

public class Grupo {

    private int id;
    private Disciplina disciplina;
    private Aluno aluno;
    private Projeto projeto;

    @org.jetbrains.annotations.Contract(pure = true)
    public Grupo() {
        super();
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Disciplina getDisciplina() {
        return disciplina;
    }

    public void setDisciplina(Disciplina disciplina) {
        this.disciplina = disciplina;
    }

}

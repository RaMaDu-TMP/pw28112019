package br.edu.usf.ads.web.models;

import br.edu.usf.ads.web.dao.CursoDAO;
import br.edu.usf.ads.web.dao.ProfessorDAO;
import br.edu.usf.ads.web.enums.DIA_SEMANA;
import br.edu.usf.ads.web.enums.TURNO;
import org.jetbrains.annotations.NotNull;

import java.sql.ResultSet;
import java.sql.SQLException;

public class Disciplina {

    private int id;
    private String nome;
    private TURNO turno;
    private DIA_SEMANA diaSemana;
    private Curso curso;
    private Professor professor;

    @org.jetbrains.annotations.Contract(pure = true)
    public Disciplina() {
        super();
    }

    public Disciplina(int id, String nome, TURNO turno, DIA_SEMANA diaSemana, Curso curso, Professor professor) {
        setId(id);
        setNome(nome);
        setTurno(turno);
        setDiaSemana(diaSemana);
        setCurso(curso);
        setProfessor(professor);
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public TURNO getTurno() {
        return turno;
    }

    public void setTurno(TURNO turno) {
        this.turno = turno;
    }

    public DIA_SEMANA getDiaSemana() {
        return diaSemana;
    }

    public Curso getCurso() {
        return curso;
    }

    public void setCurso(Curso curso) {
        this.curso = curso;
    }

    public Professor getProfessor() {
        return professor;
    }

    public void setProfessor(Professor professor) {
        this.professor = professor;
    }

    public void setDiaSemana(DIA_SEMANA diaSemana) {
        this.diaSemana = diaSemana;
    }

    @NotNull
    public static Disciplina fromDAO(@NotNull ResultSet result) throws SQLException {
        int id = result.getInt("id");
        String nome = result.getString("nome");
        TURNO turno = TURNO.valueOf(result.getString("turno"));
        DIA_SEMANA diaSemana = DIA_SEMANA.valueOf(result.getString("dia_semana"));
        Curso curso = CursoDAO.getById(result.getInt("curso_id"));
        Professor professor = ProfessorDAO.getById(result.getInt("professor_id"));

        return new Disciplina(id, nome, turno, diaSemana, curso, professor);
    }

}

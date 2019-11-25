package br.edu.usf.ads.web.models;

import br.edu.usf.ads.web.dao.AlunoDAO;
import br.edu.usf.ads.web.dao.DisciplinaDAO;
import br.edu.usf.ads.web.dao.ProjetoDAO;
import org.jetbrains.annotations.NotNull;

import java.sql.ResultSet;
import java.sql.SQLException;

public class Grupo {

    private int id;
    private Disciplina disciplina;
    private Aluno aluno;
    private Projeto projeto;

    @org.jetbrains.annotations.Contract(pure = true)
    public Grupo() {
        super();
    }

    public Grupo(int id, Disciplina disciplina, Aluno aluno, Projeto projeto) {
        setId(id);
        setDisciplina(disciplina);
        setAluno(aluno);
        setProjeto(projeto);
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

    public Aluno getAluno() {
        return aluno;
    }

    public void setAluno(Aluno aluno) {
        this.aluno = aluno;
    }

    public Projeto getProjeto() {
        return projeto;
    }

    public void setProjeto(Projeto projeto) {
        this.projeto = projeto;
    }

    public void setDisciplina(Disciplina disciplina) {
        this.disciplina = disciplina;
    }

    @NotNull
    public static Grupo fromDAO(@NotNull ResultSet result) throws SQLException {
        int id = result.getInt("id");
        Disciplina disciplina = DisciplinaDAO.getById(result.getInt("disciplina_id"));
        Aluno aluno = AlunoDAO.getById(result.getInt("aluno_id"));
        Projeto projeto = ProjetoDAO.getById(result.getInt("projeto_id"));

        return new Grupo(id, disciplina, aluno, projeto);
    }
    @NotNull
    public String tableRow() {
        return "<tr>" + "<th scope=\"row\">" + id + "</th>" +
                "<td>" + disciplina + "</td>" +
                "<td>" + aluno + "</td>" +
                "<td>" + projeto + "</td>" +
                "<td>" +
                "<span data-id=\"" + id + "\" data-disciplina-id=\"" + disciplina.getId() + "\" data-aluno-id=\"" + aluno.getId() + "\" data-projeto-id=\"" + projeto.getId() + "\" class=\"table-edit\"><a href=\"#editModal\" class=\"edit\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Editar\">&#xE254;</i></a></span>" +
                "<span data-id=\"" + id + "\" data-disciplina-id=\"" + disciplina.getId() + "\" data-aluno-id=\"" + aluno.getId() + "\" data-projeto-id=\"" + projeto.getId() + "\" class=\"table-remove\"><a href=\"#deleteModal\" class=\"delete\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Deletar\">&#xE872;</i></a></span>" +
                "</td>" +
                "</tr>";
    }

}

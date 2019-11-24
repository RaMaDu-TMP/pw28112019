package br.edu.usf.ads.web.models;

import org.jetbrains.annotations.NotNull;

import java.sql.ResultSet;
import java.sql.SQLException;

public class Aluno {

    private int id;
    private String ra;
    private String nome;

    @org.jetbrains.annotations.Contract(pure = true)
    public Aluno() {
        super();
    }

    public Aluno(int id, String ra, String nome) {
        setId(id);
        setRa(ra);
        setNome(nome);
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getRa() {
        return ra;
    }

    public void setRa(String ra) {
        this.ra = ra;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    @NotNull
    public static Aluno fromDAO(@NotNull ResultSet result) throws SQLException {
        int id = result.getInt("id");
        String ra = result.getString("ra");
        String nome = result.getString("nome");

        return new Aluno(id, ra, nome);
    }

    @NotNull
    public String tableRow() {
        return "<tr>" + "<th scope=\"row\">" + id + "</th>" +
                "<td>" + ra + "</td>" +
                "<td>" + nome + "</td>" +
                "<td>" +
                "<span data-id=\"" + id + "\" data-ra=\"" + ra + "\" data-nome=\"" + nome + "\" class=\"table-edit\"><a href=\"#editModal\" class=\"edit\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Editar\">&#xE254;</i></a></span>" +
                "<span data-id=\"" + id + "\" data-ra=\"" + ra + "\" data-nome=\"" + nome + "\" class=\"table-remove\"><a href=\"#deleteModal\" class=\"delete\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Deletar\">&#xE872;</i></a></span>" +
                "</td>" +
                "</tr>";
    }
}

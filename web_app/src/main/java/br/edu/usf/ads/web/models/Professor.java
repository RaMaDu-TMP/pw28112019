package br.edu.usf.ads.web.models;

import org.jetbrains.annotations.NotNull;

import java.sql.ResultSet;
import java.sql.SQLException;

public class Professor {

    private int id;
    private String nome;

    @org.jetbrains.annotations.Contract(pure = true)
    public Professor() {
        super();
    }

    public Professor(int id, String nome) {
        setId(id);
        setNome(nome);
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

    @NotNull
    public static Professor fromDAO(@NotNull ResultSet result) throws SQLException {
        int id = result.getInt("id");
        String nome = result.getString("nome");

        return new Professor(id, nome);
    }
}

package br.edu.usf.ads.web.models;

public class Curso {

    private int id;
    private String nome;

    @org.jetbrains.annotations.Contract(pure = true)
    public Curso() {
        super();
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

}

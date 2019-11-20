package br.edu.usf.ads.web.models;

public class Projeto {

    private int id;
    private String nome;

    @org.jetbrains.annotations.Contract(pure = true)
    public Projeto() {
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

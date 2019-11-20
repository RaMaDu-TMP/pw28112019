package br.edu.usf.ads.web.models;

public class Aluno {

    private int id;
    private String ra;
    private String nome;

    @org.jetbrains.annotations.Contract(pure = true)
    public Aluno() {
        super();
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

}

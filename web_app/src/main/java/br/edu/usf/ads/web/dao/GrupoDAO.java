package br.edu.usf.ads.web.dao;

import br.edu.usf.ads.web.controllers.Database;
import br.edu.usf.ads.web.models.Aluno;
import br.edu.usf.ads.web.models.Disciplina;
import br.edu.usf.ads.web.models.Grupo;
import br.edu.usf.ads.web.models.Projeto;
import org.jetbrains.annotations.NotNull;
import org.jetbrains.annotations.Nullable;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Collection;

public class GrupoDAO {

    public static boolean insert(Grupo grupo) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("INSERT INTO grupos(disciplina_id, aluno_id, projeto_id) VALUES(?, ?, ?)");

            fillStatementFields(grupo, stm);

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    @NotNull
    public static Collection<Grupo> getAll() {
        Connection conn = Database.connection();

        Collection<Grupo> grupos = new ArrayList<>();
        try {
            PreparedStatement stm = conn.prepareStatement("SELECT * FROM grupos");

            ResultSet result = stm.executeQuery();

            while (result.next()) {
                grupos.add(Grupo.fromDAO(result));
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return grupos;
    }

    @Nullable
    public static Grupo getById(int id) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("SELECT * FROM grupos WHERE id = ? LIMIT 1");

            stm.setInt(1, id);

            ResultSet result = stm.executeQuery();
            if (result.absolute(1)) {
                return Grupo.fromDAO(result);
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

    public static boolean update(Grupo grupo) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("UPDATE grupos SET disciplina_id = ?, aluno_id = ?, projeto_id = ? WHERE id = ?");

            fillStatementFields(grupo, stm);
            stm.setInt(4, grupo.getId());

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    public static boolean delete(int id) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("DELETE FROM grupos WHERE id = ?");

            stm.setInt(1, id);

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    private static void fillStatementFields(@NotNull Grupo grupo, PreparedStatement stm) throws SQLException {
        Disciplina disciplina = grupo.getDisciplina();
        Aluno aluno = grupo.getAluno();
        Projeto projeto = grupo.getProjeto();

        Integer disciplinaId = null;
        Integer projetoId = null;
        Integer alunoId = null;

        if (disciplina != null) {
            disciplinaId = disciplina.getId();
        }

        if (projeto != null) {
            projetoId = projeto.getId();
        }

        if (aluno != null) {
            alunoId = aluno.getId();
        }

        stm.setInt(1, disciplinaId);
        stm.setInt(2, alunoId);
        stm.setInt(3, projetoId);
    }

}

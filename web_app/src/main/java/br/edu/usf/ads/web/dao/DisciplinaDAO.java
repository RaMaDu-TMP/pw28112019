package br.edu.usf.ads.web.dao;

import br.edu.usf.ads.web.controllers.Database;
import br.edu.usf.ads.web.models.Curso;
import br.edu.usf.ads.web.models.Disciplina;
import br.edu.usf.ads.web.models.Professor;
import org.jetbrains.annotations.NotNull;
import org.jetbrains.annotations.Nullable;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Collection;

public class DisciplinaDAO {

    public static boolean insert(Disciplina disciplina) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("INSERT INTO disciplinas(nome, turno, dia_semana, curso_id, professor_id) VALUES(?, ?, ?, ?, ?)");

            fillStatementFields(disciplina, stm);

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    @NotNull
    public static Collection<Disciplina> getAll() {
        Connection conn = Database.connection();

        Collection<Disciplina> disciplinas = new ArrayList<>();
        try {
            PreparedStatement stm = conn.prepareStatement("SELECT * FROM disciplinas");

            ResultSet result = stm.executeQuery();

            while (result.next()) {
                disciplinas.add(Disciplina.fromDAO(result));
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return disciplinas;
    }

    @Nullable
    public static Disciplina getById(int id) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("SELECT * FROM disciplinas WHERE id = ? LIMIT 1");

            stm.setInt(1, id);

            ResultSet result = stm.executeQuery();
            if (result.absolute(1)) {
                return Disciplina.fromDAO(result);
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

    public static boolean update(Disciplina disciplina) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("UPDATE disciplinas SET nome = ?, turno = ?, dia_semana = ?, curso_id = ?, professor_id = ? WHERE id = ?");

            fillStatementFields(disciplina, stm);

            stm.setInt(6, disciplina.getId());

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    public static boolean delete(int id) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("DELETE FROM disciplinas WHERE id = ?");

            stm.setInt(1, id);

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    private static void fillStatementFields(@NotNull Disciplina disciplina, @NotNull PreparedStatement stm) throws SQLException {
        stm.setString(1, disciplina.getNome());

        String turno = null;
        String diaSemana = null;

        if (disciplina.getTurno() != null) {
            turno = disciplina.getTurno().toString();
        }

        if (disciplina.getDiaSemana() != null) {
            diaSemana = disciplina.getDiaSemana().toString();
        }

        stm.setString(2, turno);
        stm.setString(3, diaSemana);

        Curso curso = disciplina.getCurso();
        Professor professor = disciplina.getProfessor();

        Integer cursoId = null;
        Integer professorId = null;

        if (curso != null) {
            cursoId = curso.getId();
        }

        if (professor != null) {
            professorId = professor.getId();
        }

        stm.setInt(4, cursoId);
        stm.setInt(5, professorId);
    }

}

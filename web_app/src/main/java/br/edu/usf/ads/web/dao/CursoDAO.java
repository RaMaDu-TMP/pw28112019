package br.edu.usf.ads.web.dao;

import br.edu.usf.ads.web.controllers.Database;
import br.edu.usf.ads.web.models.Curso;
import org.jetbrains.annotations.NotNull;
import org.jetbrains.annotations.Nullable;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Collection;

public class CursoDAO {

    public static boolean insert(@NotNull Curso curso) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("INSERT INTO cursos(nome) VALUES(?)");

            stm.setString(1, curso.getNome());

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    @NotNull
    public static Collection<Curso> getAll() {
        Connection conn = Database.connection();

        Collection<Curso> cursos = new ArrayList<>();
        try {
            PreparedStatement stm = conn.prepareStatement("SELECT * FROM cursos");

            ResultSet result = stm.executeQuery();

            while (result.next()) {
                cursos.add(Curso.fromDAO(result));
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return cursos;
    }

    @Nullable
    public static Curso getById(int id) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("SELECT * FROM cursos WHERE id = ? LIMIT 1");

            stm.setInt(1, id);

            ResultSet result = stm.executeQuery();
            if (result.absolute(1)) {
                return Curso.fromDAO(result);
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

    public static boolean update(@NotNull Curso curso) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("UPDATE cursos SET nome = ? WHERE id = ?");

            stm.setString(1, curso.getNome());
            stm.setInt(2, curso.getId());

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    public static boolean delete(int id) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("DELETE FROM cursos WHERE id = ?");

            stm.setInt(1, id);

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

}

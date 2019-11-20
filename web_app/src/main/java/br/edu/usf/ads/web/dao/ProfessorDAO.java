package br.edu.usf.ads.web.dao;

import br.edu.usf.ads.web.controllers.Database;
import br.edu.usf.ads.web.models.Professor;
import org.jetbrains.annotations.NotNull;
import org.jetbrains.annotations.Nullable;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Collection;

public class ProfessorDAO {

    public static boolean insert(@NotNull Professor professor) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("INSERT INTO professores(nome) VALUES(?)");

            stm.setString(1, professor.getNome());

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    @NotNull
    public static Collection<Professor> getAll() {
        Connection conn = Database.connection();

        Collection<Professor> professores = new ArrayList<>();
        try {
            PreparedStatement stm = conn.prepareStatement("SELECT * FROM professores");

            ResultSet result = stm.executeQuery();

            while (result.next()) {
                professores.add(Professor.fromDAO(result));
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return professores;
    }

    @Nullable
    public static Professor getById(int id) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("SELECT * FROM professores WHERE id = ? LIMIT 1");

            stm.setInt(1, id);

            ResultSet result = stm.executeQuery();
            if (result.absolute(1)) {
                return Professor.fromDAO(result);
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

    public static boolean update(@NotNull Professor professor) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("UPDATE professores SET nome = ? WHERE id = ?");

            stm.setString(1, professor.getNome());
            stm.setInt(2, professor.getId());

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    public static boolean delete(int id) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("DELETE FROM professores WHERE id = ?");

            stm.setInt(1, id);

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

}

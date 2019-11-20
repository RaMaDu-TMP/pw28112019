package br.edu.usf.ads.web.dao;

import br.edu.usf.ads.web.controllers.Database;
import br.edu.usf.ads.web.models.Aluno;
import org.jetbrains.annotations.NotNull;
import org.jetbrains.annotations.Nullable;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Collection;

public class AlunoDAO {

    public static boolean insert(@NotNull Aluno a) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("INSERT INTO alunos(ra, nome) VALUES(?, ?)");

            stm.setString(1, a.getRa());
            stm.setString(2, a.getNome());

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    @NotNull
    public static Collection<Aluno> getAll() {
        Connection conn = Database.connection();

        Collection<Aluno> alunos = new ArrayList<>();
        try {
            PreparedStatement stm = conn.prepareStatement("SELECT * FROM alunos");

            ResultSet result = stm.executeQuery();

            while (result.next()) {
                alunos.add(Aluno.fromDAO(result));
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return alunos;
    }

    @Nullable
    public static Aluno getById(int id) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("SELECT * FROM alunos WHERE id = ? LIMIT 1");

            stm.setInt(1, id);

            ResultSet result = stm.executeQuery();
            if (result.absolute(1)) {
                return Aluno.fromDAO(result);
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

    public static boolean update(@NotNull Aluno a) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("UPDATE alunos SET ra = ?, nome = ? WHERE id = ?");

            stm.setString(1, a.getRa());
            stm.setString(1, a.getNome());
            stm.setInt(2, a.getId());

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    public static boolean delete(int id) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("DELETE FROM alunos WHERE id = ?");

            stm.setInt(1, id);

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

}

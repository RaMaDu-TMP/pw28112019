package br.edu.usf.ads.web.dao;

import br.edu.usf.ads.web.controllers.Database;
import br.edu.usf.ads.web.models.Projeto;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Collection;

public class ProjetoDAO {

    public static boolean insert(Projeto projeto) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("INSERT INTO projetos(nome) VALUES(?)");

            stm.setString(1, projeto.getNome());

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    public static Collection<Projeto> getAll() {
        Connection conn = Database.connection();

        Collection<Projeto> projetos = new ArrayList<>();
        try {
            PreparedStatement stm = conn.prepareStatement("SELECT * FROM projetos");

            ResultSet result = stm.executeQuery();

            while (result.next()) {
                projetos.add(Projeto.fromDAO(result));
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return projetos;
    }

    public static Projeto getById(int id) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("SELECT * FROM projetos WHERE id = ? LIMIT 1");

            stm.setInt(1, id);

            ResultSet result = stm.executeQuery();
            if (result.absolute(1)) {
                return Projeto.fromDAO(result);
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

    public static boolean update(Projeto projeto) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("UPDATE projetos SET nome = ? WHERE id = ?");

            stm.setString(1, projeto.getNome());
            stm.setInt(2, projeto.getId());

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    public static boolean delete(int id) {
        Connection conn = Database.connection();

        try {
            PreparedStatement stm = conn.prepareStatement("DELETE FROM projetos WHERE id = ?");

            stm.setInt(1, id);

            return stm.execute();

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

}

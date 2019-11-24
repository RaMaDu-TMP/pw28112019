package br.edu.usf.ads.web.controllers;

import org.jetbrains.annotations.Contract;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class Database {
    private static final Database instance = new Database();

    private static final String host = "localhost";
    private static final String db = "pw28112019";
    private static final String user = "root";
    private static final String pass = "";

   private static Connection conn;

    @Contract(pure = true)
    private Database () {
        tryToConnect();
    }

    private static void tryToConnect() {
        String url = "jdbc:mysql://" + host + "/" + db;

        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            conn = DriverManager.getConnection(url, user, pass);

        } catch (ClassNotFoundException | SQLException e) {
            System.err.println(e.getMessage());
        }
    }

    @Contract(pure = true)
    public static Connection connection() {
        if (conn == null) {
            tryToConnect();
        }

        return conn;
    }
}

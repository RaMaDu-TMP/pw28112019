package br.edu.usf.ads.web.controllers;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class Database {
    private static final Database instance;
    static {
        instance = new Database();
    }

    private static final String host = "localhost";
    private static final String db = "pw28112019";
    private static final String user = "root";
    private static final String pass = "";

   private static Connection conn;

    private Database () {
        String url = "jdbc:mysql://" + host +"/" + db + "";

        try {
            Class.forName("com.mysql.jdbc.Driver");
            conn = DriverManager.getConnection(url, user, pass);

        } catch (ClassNotFoundException | SQLException e) {
            e.printStackTrace();
            System.out.println(e.getMessage());
        }
    }

    public static Connection connection() {
        return conn;
    }
}

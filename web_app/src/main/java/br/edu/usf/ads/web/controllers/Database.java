package br.edu.usf.ads.web.controllers;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class Database {
    private static final String URL = "jdbc:mysql://localhost/aulaweb";

    public Connection connection() {
        try {
            Class.forName("com.mysql.jdbc.Driver");

            return DriverManager.getConnection(URL, "root", "");

        } catch (ClassNotFoundException | SQLException e) {
            e.printStackTrace();
            System.out.println(e.getMessage());
        }
        return null;
    }
}

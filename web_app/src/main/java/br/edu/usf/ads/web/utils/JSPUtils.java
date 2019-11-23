package br.edu.usf.ads.web.utils;

import org.jetbrains.annotations.NotNull;

public class JSPUtils {

    public static String tableRow(Object rowId, Object... columns) {
        return "<tr><td><span class=\"custom-checkbox\"><input type=\"checkbox\" id=\"checkbox1\" name=\"options[]\" value=\"1\"><label for=\"chk" + rowId + "\"></label></span></td>" +
                tableColumns(columns) +
                "<td>" +
                "<a href=\"#editEmployeeModal\" class=\"edit\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Edit\">&#xE254;</i></a>" +
                "<a href=\"#deleteEmployeeModal\" class=\"delete\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Delete\">&#xE872;</i></a>" +
                "</td></tr>";
    }

    @NotNull
    private static String tableColumns(@NotNull Object... columns) {
        StringBuilder ret = new StringBuilder();

        for (Object obj :
                columns) {
            ret.append("<td>").append(obj).append("</td>");
        }

        return ret.toString();
    }
}

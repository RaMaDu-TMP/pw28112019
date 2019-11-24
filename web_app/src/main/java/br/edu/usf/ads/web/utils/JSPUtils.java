package br.edu.usf.ads.web.utils;

import org.jetbrains.annotations.Contract;
import org.jetbrains.annotations.NotNull;

import java.util.Collection;
import java.util.Map;

public class JSPUtils {

    @NotNull
    public static String tableRow(Object rowId, @NotNull Map<Object, Object> data) {
        return "<tr>" + "<th scope=\"row\">" + rowId + "</th>" +
                tableColumns(data.values()) +
                "<td>" +
                "<span " + mapToProperties(data) + " class=\"table-edit\"><a href=\"#editModal\" class=\"edit\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Editar\">&#xE254;</i></a></span>\n" +
                "<span " + mapToProperties(data) + " class=\"table-remove\"><a href=\"#deleteModal\" class=\"delete\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Deletar\">&#xE872;</i></a></span>" +
                "</td>" +
                "</tr>";
    }

    @NotNull
    private static String tableColumns(@NotNull Collection<?> columns) {
        StringBuilder ret = new StringBuilder();

        for (Object obj : columns) {
            ret.append("<td>").append(obj).append("</td>");
        }

        return ret.toString();
    }

    @NotNull
    private static String mapToProperties(@NotNull Map<Object, Object> map) {
        StringBuilder ret = new StringBuilder();

        for (Map.Entry<Object, Object> obj : map.entrySet()) {
            ret.append(" ").append(obj.getKey()).append(" ").append(obj.getValue());
        }

        return ret.toString();
    }

}

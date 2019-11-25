<%@ page import="br.edu.usf.ads.web.models.Curso" %>
<%@ page import="br.edu.usf.ads.web.dao.CursoDAO" %>
<%@ page import="com.google.common.base.Strings" %>

<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<body>
<%
    try {
        if (!Strings.isNullOrEmpty(request.getParameter("id")) && !Strings.isNullOrEmpty(request.getParameter("nome"))) {
            Curso c = new Curso();
            c.setId(Integer.valueOf(request.getParameter("id")));
            c.setNome(request.getParameter("nome"));

            CursoDAO.update(c);
        }
        response.sendRedirect("../index.jsp");
    } catch(Exception e) {
        out.print("Erro ao atualizar!");
    }
%>
</body>
</html>

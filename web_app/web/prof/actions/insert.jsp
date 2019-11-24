<%@ page import="br.edu.usf.ads.web.models.Professor" %>
<%@ page import="br.edu.usf.ads.web.dao.ProfessorDAO" %>
<%@ page import="com.google.common.base.Strings" %>

<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<body>
<%
    try {
        if (!Strings.isNullOrEmpty(request.getParameter("nome"))) {
            Professor p = new Professor();
            p.setNome(request.getParameter("nome"));

            ProfessorDAO.insert(p);
        }
        response.sendRedirect("../index.jsp");
    } catch(Exception e) {
        out.print("Erro ao inserir!");
    }
%>
</body>
</html>

<%@ page import="br.edu.usf.ads.web.models.Projeto" %>
<%@ page import="br.edu.usf.ads.web.dao.ProjetoDAO" %>
<%@ page import="com.google.common.base.Strings" %>

<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<body>
<%
    try {
        if (!Strings.isNullOrEmpty(request.getParameter("id")) && !Strings.isNullOrEmpty(request.getParameter("nome"))) {
            Projeto c = new Projeto();
            c.setId(Integer.valueOf(request.getParameter("id")));
            c.setNome(request.getParameter("nome"));

            ProjetoDAO.update(c);
        }
        response.sendRedirect("../index.jsp");
    } catch(Exception e) {
        out.print("Erro ao atualizar!");
    }
%>
</body>
</html>

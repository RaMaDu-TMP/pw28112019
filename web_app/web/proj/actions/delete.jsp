<%@ page import="br.edu.usf.ads.web.dao.ProjetoDAO" %>
<%@ page import="com.google.common.base.Strings" %>

<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<body>
<%
    try {
        if (!Strings.isNullOrEmpty(request.getParameter("id"))) {
            ProjetoDAO.delete(Integer.valueOf(request.getParameter("id")));;
        }
        response.sendRedirect("../index.jsp");
    } catch(Exception e) {
        out.print("Erro ao deletar!");
    }
%>
</body>
</html>

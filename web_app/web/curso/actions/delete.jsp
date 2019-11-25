<%@ page import="br.edu.usf.ads.web.dao.CursoDAO" %>
<%@ page import="com.google.common.base.Strings" %>

<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<body>
<%
    try {
        if (!Strings.isNullOrEmpty(request.getParameter("id"))) {
            CursoDAO.delete(Integer.valueOf(request.getParameter("id")));;
        }
        response.sendRedirect("../index.jsp");
    } catch(Exception e) {
        out.print("Erro ao deletar!");
    }
%>
</body>
</html>

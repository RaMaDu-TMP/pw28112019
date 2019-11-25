<%@ page import="com.google.common.base.Strings" %>
<%@ page import="br.edu.usf.ads.web.models.Disciplina" %>
<%@ page import="br.edu.usf.ads.web.dao.DisciplinaDAO" %>
<%@ page import="br.edu.usf.ads.web.enums.TURNO" %>
<%@ page import="br.edu.usf.ads.web.enums.DIA_SEMANA" %>
<%@ page import="br.edu.usf.ads.web.dao.CursoDAO" %>
<%@ page import="br.edu.usf.ads.web.dao.ProfessorDAO" %>

<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<body>
<%
    try {
        if (!Strings.isNullOrEmpty(request.getParameter("nome"))
                && !Strings.isNullOrEmpty(request.getParameter("turno"))
                && !Strings.isNullOrEmpty(request.getParameter("dia-semana"))
                && !Strings.isNullOrEmpty(request.getParameter("curso-id"))
                && !Strings.isNullOrEmpty(request.getParameter("professor-id"))) {

            Disciplina d = new Disciplina();
            d.setNome(request.getParameter("nome"));
            d.setTurno(TURNO.valueOf(request.getParameter("turno")));
            d.setDiaSemana(DIA_SEMANA.valueOf(request.getParameter("dia-semana")));
            d.setCurso(CursoDAO.getById(Integer.valueOf(request.getParameter("curso-id"))));
            d.setProfessor(ProfessorDAO.getById(Integer.valueOf(request.getParameter("professor-id"))));

            DisciplinaDAO.insert(d);
        }
        response.sendRedirect("../index.jsp");
    } catch(Exception e) {
        out.print("Erro ao inserir!");
    }
%>
</body>
</html>

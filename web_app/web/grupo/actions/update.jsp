<%@ page import="com.google.common.base.Strings" %>
<%@ page import="br.edu.usf.ads.web.models.Grupo" %>
<%@ page import="br.edu.usf.ads.web.dao.*" %>

<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<body>
<%
    try {
        if (!Strings.isNullOrEmpty(request.getParameter("id"))
                && !Strings.isNullOrEmpty(request.getParameter("disciplina-id"))
                && !Strings.isNullOrEmpty(request.getParameter("aluno-id"))
                && !Strings.isNullOrEmpty(request.getParameter("projeto-id"))) {

            Grupo g = new Grupo();
            g.setId(Integer.valueOf(request.getParameter("id")));
            g.setDisciplina(DisciplinaDAO.getById(Integer.parseInt(request.getParameter("disciplina-id"))));
            g.setAluno(AlunoDAO.getById(Integer.parseInt(request.getParameter("aluno-id"))));
            g.setProjeto(ProjetoDAO.getById(Integer.parseInt(request.getParameter("projeto-id"))));

            GrupoDAO.update(g);
        }
        response.sendRedirect("../index.jsp");
    } catch(Exception e) {
        out.print("Erro ao atualizar!");
    }
%>
</body>
</html>

<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
  <head>
    <title>CRUD</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="index.css"/>
  </head>
  <body>
    <h1>CRUD - Web</h1>

    <div class="btn-group">
      <input type="button" class="btn btn-primary" onclick="location.href='./aluno/index.jsp';" value="Alunos" />
      <input type="button" class="btn btn-primary" onclick="location.href='./curso/index.jsp';" value="Cursos" />
      <input type="button" class="btn btn-primary" onclick="location.href='./disc/index.jsp';" value="Disciplinas" />
      <input type="button" class="btn btn-primary" onclick="location.href='./grupo/index.jsp';" value="Grupos" />
      <input type="button" class="btn btn-primary" onclick="location.href='./prof/index.jsp';" value="Professores" />
      <input type="button" class="btn btn-primary" onclick="location.href='./proj/index.jsp';" value="Projetos" />
    </div>
  </body>
</html>

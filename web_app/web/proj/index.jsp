<%@ page import="br.edu.usf.ads.web.dao.ProjetoDAO" %>
<%@ page import="br.edu.usf.ads.web.models.Projeto" %>
<%@ page import="java.util.Collection" %>

<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Projetos</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="index.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="./index.js"></script>
</head>
<body>
<a type="button" href="../index.jsp" class="btn btn-outline-primary">Voltar</a>
<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2><b>Projetos</b></h2>
                </div>
                <div class="col-sm-6">
                    <span class="table-add"><a href="#addModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar novo projeto</span></a></span>
                </div>
            </div>
        </div>
        <table class="table table-striped w-auto" id="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <%
                Collection<Projeto> projetos = ProjetoDAO.getAll();

                for (Projeto p : projetos) {
                    out.print(p.tableRow());
                }
            %>
            </tbody>
        </table>
    </div>
</div>
<!-- Add Modal HTML -->
<div id="addModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="actions/insert.jsp" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Projeto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" id="add-nome" name="nome" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-success" value="Adicionar">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal HTML -->
<div id="editModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="actions/update.jsp" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Projeto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="deleteModalform-group">
                        <input type="hidden" class="form-control" id="edit-id" name="id">
                        <label>Nome</label>
                        <input type="text" class="form-control" id="edit-nome" name="nome" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-info" value="Salvar">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="actions/delete.jsp" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Deletar Projeto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="delete-id" name="id">
                    <p>Tem certeza que deseja apagar o projeto?</p>
                    <p class="text-warning"><small>Esta ação não pode ser desfeita</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-danger" value="Deletar">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
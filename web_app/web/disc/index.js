
// Edit
$(document).ready(function() {
    $('.table-edit').click(function() {
        var id = $(this).attr('data-id');
        var nome = $(this).attr('data-nome');
        var turno = $(this).attr('data-turno');
        var dia_semana = $(this).attr('data-dia-semana');
        var curso_id = $(this).attr('data-curso-id');
        var professor_id = $(this).attr('data-professor-id');

        $('#edit-id').val(id);
        $('#edit-nome').val(nome);
        $('#edit-turno').val(turno);
        $('#edit-dia-semana').val(dia_semana);
        $('#edit-curso').val(curso_id);
        $('#edit-professor').val(professor_id);

        console.log(id);
        console.log(nome);
        console.log(turno);
        console.log(dia_semana);
        console.log(curso_id);
        console.log(professor_id);
    });
});

// Delete
$(document).ready(function() {
    $('.table-remove').click(function() {
        var id = $(this).attr('data-id');

        $('#delete-id').val(id);

        console.log(id);
    });
});

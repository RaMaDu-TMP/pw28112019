
// Edit
$(document).ready(function() {
    $('.table-edit').click(function() {
        var id = $(this).attr('data-id');
        var disciplina_id = $(this).attr('data-disciplina-id');
        var aluno_id = $(this).attr('data-aluno-id');
        var projeto_id = $(this).attr('data-projeto-id');

        $('#edit-id').val(id);
        $('#edit-disciplina').val(disciplina_id);
        $('#edit-aluno').val(aluno_id);
        $('#edit-projeto').val(projeto_id);

        console.log(disciplina_id);
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


// Edit
$(document).ready(function() {
    $('.table-edit').click(function() {
        var id = $(this).attr('data-id');
        var nome = $(this).attr('data-nome');

        $('#edit-id').val(id);
        $('#edit-nome').val(nome);
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

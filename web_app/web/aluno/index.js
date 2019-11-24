
// Edit
$(document).ready(function() {
    $('.table-edit').click(function() {
        var id = $(this).attr('data-id');
        var ra = $(this).attr('data-ra');
        var nome = $(this).attr('data-nome');

        $('#edit-id').val(id);
        $('#edit-ra').val(ra);
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

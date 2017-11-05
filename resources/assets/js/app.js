require('./bootstrap');

$(function() {
    
    // Put file name into the input text
    $('#import-file').change(function(e) {
        $('#import-label').val($(this).val().split('\\').pop());
    });

    // Submit button
    $('#import-submit').click(function(e){
        $('#import').submit();
    });
});
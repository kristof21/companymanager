$(document).ready(function() {
    $( "#edit-company" ).click(function() {
        $('input[type=text]').removeAttr('readonly');
        $( ".save" ).removeClass( "d-none" );
        $(".file-upload").removeAttr('disabled');
    });
});

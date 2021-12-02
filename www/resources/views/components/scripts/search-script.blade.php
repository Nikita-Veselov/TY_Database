<script>

// Live search section
$(document).ready(function(){

// Search all columns
    $('#txt_searchall').keyup(function(){
        // Hide nav
        $('#nav').hide();

        // Search Text
        var search = $(this).val();

        // Hide all table tbody rows
        $('#data tbody tr').hide();

        // Count total search result
        var len = $('#data tbody tr:not(.notfound) td:contains("'+search+'")').length;

        if(len > 0){
            // Searching text in columns and show match row
            $('#data tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
                $(this).closest('tr').show();
            });
        }

        // paginate if deleted search text
        if (!$(this).val()) {
            $('#nav').show();
            paginate();
        }
    });

    // Case-insensitive searching
    $.expr[":"].contains = $.expr.createPseudo(function(arg) {
        return function( elem ) {
            return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
        };
    });

});

</script>

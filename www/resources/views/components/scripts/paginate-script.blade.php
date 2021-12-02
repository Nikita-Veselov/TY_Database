<script>

    // Pagination section
    $('#rowsShown').change(function() {
        var rowsShown = $('#rowsShown option:selected').val();
        paginate(rowsShown);
    });

    $(document).ready(function(){
        var rowsShown = $('#rowsShown option:selected').val();
        paginate(rowsShown);
    });

    function paginate (rowsShown) {
        $('#pag').append('<ul class="pagination" id="nav"></ul>');
        if (rowsShown === undefined) {
            rowsShown = 10;
        }
        // count pages
        var rowsTotal = $('#data tbody tr').length;
        var numPages = rowsTotal/rowsShown;

        // nav creation
        $('#nav').empty();
        if (numPages > 1) {
            for(i = 0; i < numPages; i++) {
                var pageNum = i + 1;
                $('#nav').append('<li class="page-item"><a href="#" rel="'+i+'" class="page-link">'+pageNum+'</a></li>');
            }
        }
        $('#nav li:first').addClass('active');

        // hide excess rows
        $('#data tbody tr').hide();
        $('#data tbody tr').slice(0, rowsShown).show();

        $('#nav li').bind('click', function(){
            $('#nav li').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).children().attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#data tbody tr').hide().slice(startItem, endItem).
            css('display','table-row').animate({opacity:1}, 300);
        });
    }

</script>

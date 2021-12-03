<script>

$(document).ready(paginate());

function paginate(){

    $('#pag').empty();
    $('#pag').append('<ul class="pagination justify-content-center" id="nav"></ul>');

    // get the main block height
    main = $('#data').height();
    // get the table row height
    row = $('#data tbody tr').height();
    // get the search bar and pagination height
    nav = $('#pag ul').height();
    search = $('#search').height();
    bars = nav + search;
    // count how many rows can fit, cut by 2 for paddings and margins
    var rowsShown = Math.round(((main-bars)/(row))/2);

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

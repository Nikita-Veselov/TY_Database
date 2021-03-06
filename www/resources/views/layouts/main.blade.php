<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>База данных ТУ</title>

        {{-- Mix CSS and JS --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

</head>
<body>
    <div class="container d-flex flex-column mx-auto vh-100">

        <x-header  />

        <div class="main row justify-content-center flex-grow-1">
            @yield('content')
        </div>

        <x-footer />

        <script>
                // delete confirmation
            $(".delete").on("submit", function(){
                return confirm("Точно хочешь удалить?");
            });
                // alert auto closing
            $(".alert").delay(4000).slideUp(200, function() {
                $(this).alert('close');
            });
        </script>
    </div>
</body>
</html>

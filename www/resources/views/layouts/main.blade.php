<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Database</title>

        {{-- Mix CSS and JS --}}
    <link href="assets/css/app.css" rel="stylesheet" type="text/css">
    <script src="assets/js/app.js" type="text/javascript"></script>

</head>
<body>
    <div class="container d-flex flex-column mx-auto vh-100">
        <x-header />

        <div class="main flex-grow-1">
            @yield('content')
        </div>

        <x-footer />
    </div>
</body>
</html>

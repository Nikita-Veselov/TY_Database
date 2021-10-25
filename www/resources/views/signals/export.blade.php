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
        <div class="main flex-grow-1">
            <div class="row justify-content-center">
                <div class="text-start fs-4">Таблица ТС</div>
                <table class="table table-bordered table-sm mb-5">
                    <thead class="text-center align-middle">
                    <tr>
                        <th scope="col" class="col-4">Название сигнала</th>
                        @if ($CP->type != "ТП")
                            <th scope="col" class="col-1">Клемма КП-М (ПС)</th>
                        @endif
                        <th scope="col" class="col-1">№ ТС</th>
                        @if ($CP->type != "ТП")
                            <th scope="col" class="col-1">Инверсия в настройке</th>
                        @endif
                        <th scope="col" class="col-3">Оперативное название сигнала</th>
                        <th scope="col" class="col-1">Соответствие сигнала с ДП</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($TC as $tc)
                        <tr class="text-center">
                            <td>{{ $tc->name }}</td>
                            @if ($CP->type != "ТП")
                                <td>{{ $tc->klemm }}</td>
                            @endif
                            <td>{{ $tc->number }}</td>
                            @if ($CP->type != "ТП")
                                <td>{{ $tc->invert }}</td>
                            @endif
                            <td>{{ $tc->oper }}</td>
                            <td>{{ $tc->DP }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-start fs-4">Таблица ТУ</div>
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr class="text-center align-middle">
                        <th scope="col" class="col-4">Название сигнала</th>
                        @if ($CP->type != "ТП")
                            <th scope="col" class="col-2">Клемма КП-М (ПС)</th>
                        @endif
                        <th scope="col" class="col-1">№ ТУ</th>
                        <th scope="col" class="col-3">Оперативное название сигнала</th>
                        <th scope="col" class="col-1">Соответствие сигнала с ДП</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($TY as $ty)
                        <tr>
                            <td class="text-start">{{ $ty->name }}</td>
                            @if ($CP->type != "ТП")
                                <td>{{ $ty->klemm }}</td>
                            @endif
                            <td>{{ $ty->number }}</td>
                            <td>{{ $ty->oper }}</td>
                            <td>{{ $ty->DP }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

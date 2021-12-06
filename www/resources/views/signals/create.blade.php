@extends('layouts.main')

@section('content')

<div class="col-12 mt-5">
    <div class="row">
        <div class="col fs-2 text-center">{{ $CP->name }}</div>
    </div>
    <div class="row">
    <form method="POST" action="{{ url('signals') }}">
        @csrf
        <input type="hidden" name="CP" value="{{ $CP->code }}">
        <input type="hidden" name="TCcount" value="" id="TCcount">
        <input type="hidden" name="TYcount" value="" id="TYcount">

        <table class="table table-bordered table-sm col-12 mb-5" id="TCtable">
            <thead class="text-center align-middle">
            <tr>
                <th></th>
                <th scope="col" class="col-4">Название сигнала</th>
                @if ($CP->type != "ТП")
                    <th scope="col" class="col-2">Клемма КП-М (ПС)</th>
                @endif
                <th scope="col" @if ($CP->type != "ТП") class="col-1" @else class="col-2" @endif>№ ТС</th>
                @if ($CP->type != "ТП")
                    <th scope="col" class="col-1">Инверсия в настройке</th>
                @endif
                <th scope="col" @if ($CP->type != "ТП") class="col-3" @else class="col-4" @endif>Оперативное название сигнала</th>
                <th scope="col" @if ($CP->type != "ТП") class="col-1" @else class="col-2" @endif>Соответствие сигнала с ДП</th>
            </tr>
            </thead>
            <tbody>
                <button type="button" name="addTC" id="addTC" class="btn btn-warning">Добавить строку</button>
                <tr class="text-center">
                    <td><div class="fw-bold lh-lg" style="color: rgb(175, 175, 175)">X</div></td>
                    <td><input class="w-100" type="text" name="{{ Str::of('name')->append(1)->append('TC') }}" required></td>
                    @if ($CP->type != "ТП")
                        <td><input class="w-100" type="text" name="{{ Str::of('klemm')->append(1)->append('TC') }}" required></td>
                    @endif
                    <td><input class="w-100" type="text" name="{{ Str::of('number')->append(1)->append('TC') }}" required></td>
                    @if ($CP->type != "ТП")
                        <td><input class="w-100" type="text" name="{{ Str::of('invert')->append(1)->append('TC') }}" required></td>
                    @endif
                    <td><input class="w-100" type="text" name="{{ Str::of('oper')->append(1)->append('TC') }}" required></td>
                    <td><input class="w-100" type="text" name="{{ Str::of('DP')->append(1)->append('TC') }}" required></td>
                </tr>

            </tbody>
        </table>

        <script>
            let i = 1;
            $( '#addTC' ).click(function(){
                ++i;
                $("#TCtable").append(`<tr class="text-center"><td class="removeTC"><div class="fw-bold lh-lg">X</div></td><td><input class="w-100" type="text" name="{{ Str::of('name')->append('${i}')->append('TC') }}" required></td> @if ($CP->type != "ТП") <td><input class="w-100" type="text" name="{{ Str::of('klemm')->append('${i}')->append('TC') }}" required></td> @endif <td><input class="w-100" type="text" name="{{ Str::of('number')->append('${i}')->append('TC') }}" required></td> @if ($CP->type != "ТП") <td><input class="w-100" type="text" name="{{ Str::of('invert')->append('${i}')->append('TC') }}" required></td> @endif <td><input class="w-100" type="text" name="{{ Str::of('oper')->append('${i}')->append('TC') }}" required></td><td><input class="w-100" type="text" name="{{ Str::of('DP')->append('${i}')->append('TC') }}" required></td></tr>`);
                $('#TCcount').val(i);
            });

            $(document).on('click', '.removeTC', function(){
                $(this).parents('tr').remove();
            });
        </script>

        <table class="table table-bordered table-sm col-12" id="TYtable">
            <thead>
            <tr class="text-center align-middle">
                <th></th>
                <th scope="col" class="col-4">Название сигнала</th>
                @if ($CP->type != "ТП")
                    <th scope="col" class="col-2">Клемма КП-М (ПС)</th>
                @endif
                <th scope="col" @if ($CP->type != "ТП") class="col-1" @else class="col-2" @endif>№ ТУ</th>
                <th scope="col" class="col-4">Оперативное название сигнала</th>
                <th scope="col" @if ($CP->type != "ТП") class="col-1" @else class="col-2" @endif>Соответствие сигнала с ДП</th>
            </tr>
            </thead>
            <tbody>
                <button type="button" name="addTY" id="addTY" class="btn btn-warning">Добавить строку</button>
                <tr class="text-center">
                    <td><div class="fw-bold lh-lg" style="color: rgb(175, 175, 175)">X</div></td>
                    <td><input class="w-100" type="text" name="{{ Str::of('name')->append(1)->append('TY') }}" required></td>
                    @if ($CP->type != "ТП")
                        <td><input class="w-100" type="text" name="{{ Str::of('klemm')->append(1)->append('TY') }}" required></td>
                    @endif
                    <td><input class="w-100" type="text" name="{{ Str::of('number')->append(1)->append('TY') }}" required></td>
                    <td><input class="w-100" type="text" name="{{ Str::of('oper')->append(1)->append('TY') }}" required></td>
                    <td><input class="w-100" type="text" name="{{ Str::of('DP')->append(1)->append('TY') }}" required></td>
                </tr>
            </tbody>
        </table>

        <script>
            let j = 1;
            $( '#addTY' ).click(function(){
                ++j;
                $("#TYtable").append(`<tr class="text-center"><td class="removeTY"><div class="fw-bold lh-lg">X</div></td><td><input class="w-100" type="text" name="{{ Str::of('name')->append('${j}')->append('TY') }}" required></td> @if ($CP->type != "ТП") <td><input class="w-100" type="text" name="{{ Str::of('klemm')->append('${j}')->append('TY') }}" required></td> @endif <td><input class="w-100" type="text" name="{{ Str::of('number')->append('${j}')->append('TY') }}" required></td><td><input class="w-100" type="text" name="{{ Str::of('oper')->append('${j}')->append('TY') }}" required></td><td><input class="w-100" type="text" name="{{ Str::of('DP')->append('${j}')->append('TY') }}" required></td></tr>`);
                $('#TYcount').val(j);
            });

            $(document).on('click', '.removeTY', function(){
                $(this).parents('tr').remove();
            });
        </script>

        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>
</div>
@endsection

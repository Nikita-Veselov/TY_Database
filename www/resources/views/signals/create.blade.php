@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col fs-2 text-center">{{ $CP->name }}</div>
</div>

<form method="POST" action="{{ url('signals') }}">
    @csrf
    <input type="hidden" name="CP" value="{{ $CP->code }}">
    <input type="hidden" name="TCcount" value="" id="TCcount">
    <input type="hidden" name="TYcount" value="" id="TYcount">

    <table class="table table-bordered table-sm mb-5" id="TCtable">
        <thead class="text-center align-middle">
        <tr>
            <th>Del</th>
            <th scope="col">Название сигнала</th>
            <th scope="col">Клемма КП-М (ПС)</th>
            <th scope="col">№ ТС</th>
            <th scope="col">Инверсия в настройке</th>
            <th scope="col">Оперативное название сигнала</th>
            <th scope="col">Соответствие сигнала с ДП</th>
        </tr>
        </thead>
        <tbody>
            <button type="button" name="addTC" id="addTC" class="btn btn-success">Add More</button>
            <tr class="text-center">
                <td></td>
                <td><input type="text" name="{{ Str::of('name')->append(1)->append('TC') }}"></td>
                <td><input type="text" name="{{ Str::of('klemm')->append(1)->append('TC') }}"></td>
                <td><input type="text" name="{{ Str::of('number')->append(1)->append('TC') }}"></td>
                <td><input type="text" name="{{ Str::of('invert')->append(1)->append('TC') }}"></td>
                <td><input type="text" name="{{ Str::of('oper')->append(1)->append('TC') }}"></td>
                <td><input type="text" name="{{ Str::of('DP')->append(1)->append('TC') }}"></td>
            </tr>

        </tbody>
    </table>


    <script>
        let i = 1;
        $( '#addTC' ).click(function(){
            ++i;
            $("#TCtable").append(`<tr class="text-center"><td class="removeTC"><div>X</div></td><td><input type="text" name="{{ Str::of('name')->append('${i}')->append('TC') }}"></td><td><input type="text" name="{{ Str::of('klemm')->append('${i}')->append('TC') }}"></td><td><input type="text" name="{{ Str::of('number')->append('${i}')->append('TC') }}"></td><td><input type="text" name="{{ Str::of('invert')->append('${i}')->append('TC') }}"></td><td><input type="text" name="{{ Str::of('oper')->append('${i}')->append('TC') }}"></td><td><input type="text" name="{{ Str::of('DP')->append('${i}')->append('TC') }}"></td></tr>`);
            $('#TCcount').val(i);
        });

        $(document).on('click', '.removeTC', function(){
            $(this).parents('tr').remove();
        });
    </script>

    <table class="table table-bordered table-sm table-fixed" id="TYtable">
        <thead>
        <tr class="text-center align-middle">
            <th>Del</th>
            <th scope="col">Название сигнала</th>
            <th scope="col">Клемма КП-М (ПС)</th>
            <th scope="col">№ ТУ</th>
            <th scope="col">Оперативное название сигнала</th>
            <th scope="col">Соответствие сигнала с ДП</th>
        </tr>
        </thead>
        <tbody>

            <button type="button" name="addTY" id="addTY" class="btn btn-success">Add More</button>
            <tr class="text-center">
                <td></td>
                <td><input type="text" name="{{ Str::of('name')->append(1)->append('TY') }}"></td>
                <td><input type="text" name="{{ Str::of('klemm')->append(1)->append('TY') }}"></td>
                <td><input type="text" name="{{ Str::of('number')->append(1)->append('TY') }}"></td>
                <td><input type="text" name="{{ Str::of('oper')->append(1)->append('TY') }}"></td>
                <td><input type="text" name="{{ Str::of('DP')->append(1)->append('TY') }}"></td>
            </tr>
        </tbody>
    </table>

    <script>
        let j = 1;
        $( '#addTY' ).click(function(){
            ++j;
            $("#TYtable").append(`<tr class="text-center"><td class="removeTY"><div>X</div></td><td><input type="text" name="{{ Str::of('name')->append('${j}')->append('TY') }}"></td><td><input type="text" name="{{ Str::of('klemm')->append('${j}')->append('TY') }}"></td><td><input type="text" name="{{ Str::of('number')->append('${j}')->append('TY') }}"></td><td><input type="text" name="{{ Str::of('oper')->append('${j}')->append('TY') }}"></td><td><input type="text" name="{{ Str::of('DP')->append('${j}')->append('TY') }}"></td></tr>`);
            $('#TYcount').val(j);
        });

        $(document).on('click', '.removeTY', function(){
            $(this).parents('tr').remove();
        });
    </script>

    <button type="submit" class="btn btn-primary">Добавить</button>
</form>
@endsection

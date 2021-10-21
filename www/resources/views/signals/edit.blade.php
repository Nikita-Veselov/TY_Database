@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('signals.update', ['signal' => $CP->code]) }}">
    @method('PUT')
    @csrf
    <input type="hidden" name="CP" value="{{ $CP->code }}">
    <input type="hidden" name="TCcount" value="" id="TCCount">
    <input type="hidden" name="TYcount" value="" id="TYCount">

    <table class="table table-bordered table-sm mb-5" id="TCtable">
        <thead class="text-center align-middle">
        <tr>
            <th></th>
            <th scope="col" class="col-4">Название сигнала</th>
            @if ($CP->type != "ТП")
                <th scope="col" class="col-1">Клемма КП-М (ПС)</th>
            @endif
            <th scope="col" @if ($CP->type != "ТП") class="col-1" @else class="col-2" @endif>№ ТС</th>
            @if ($CP->type != "ТП")
                <th scope="col" class="col-1">Инверсия в настройке</th>
            @endif
            <th scope="col" class="col-4">Оперативное название сигнала</th>
            <th scope="col" @if ($CP->type != "ТП") class="col-1" @else class="col-2" @endif>Соответствие сигнала с ДП</th>
        </tr>
        </thead>
        <tbody>
            <button type="button" name="addTC" id="addTC" class="btn btn-success">Добавить строку</button>
            @foreach ($TC as $tc)
            <tr class="text-center">
                <td></td>
                <td><input class="w-100" type="text" name="{{ Str::of('name')->append($tc->id)->append('TC') }}" value="{{ $tc->name }}"></td>
                @if ($CP->type != "ТП")
                    <td><input class="w-100" type="text" name="{{ Str::of('klemm')->append($tc->id)->append('TC') }}" value="{{ $tc->klemm }}"></td>
                @endif
                <td><input class="w-100" type="text" name="{{ Str::of('number')->append($tc->id)->append('TC') }}" value="{{ $tc->number }}"></td>
                @if ($CP->type != "ТП")
                    <td><input class="w-100" type="text" name="{{ Str::of('invert')->append($tc->id)->append('TC') }}" value="{{ $tc->invert }}"></td>
                @endif
                <td><input class="w-100" type="text" name="{{ Str::of('oper')->append($tc->id)->append('TC') }}" value="{{ $tc->oper }}"></td>
                <td><input class="w-100" type="text" name="{{ Str::of('DP')->append($tc->id)->append('TC') }}" value="{{ $tc->DP }}"></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        let i = @json($tc->id);
        $('#TCCount').val(i);
        $( '#addTC' ).click(function(){
            ++i;
            $("#TCtable").append(`<tr class="text-center"><td class="removeTC"><div>X</div></td><td><input class="w-100" type="text" name="{{ Str::of('name')->append('${i}')->append('TC') }}"></td> @if ($CP->type != "ТП") <td><input class="w-100" type="text" name="{{ Str::of('klemm')->append('${i}')->append('TC') }}"></td> @endif <td><input class="w-100" type="text" name="{{ Str::of('number')->append('${i}')->append('TC') }}"></td> @if ($CP->type != "ТП") <td><input class="w-100" type="text" name="{{ Str::of('invert')->append('${i}')->append('TC') }}"></td> @endif <td><input class="w-100" type="text" name="{{ Str::of('oper')->append('${i}')->append('TC') }}"></td><td><input class="w-100" type="text" name="{{ Str::of('DP')->append('${i}')->append('TC') }}"></td></tr>`);
            $('#TCCount').val(i);
        });

        $(document).on('click', '.removeTC', function(){
            $(this).parents('tr').remove();
            $('#TCCount').val(--i);
        });
    </script>

    <table class="table table-bordered table-sm table-fixed" id="TYtable">
        <thead>
        <tr class="text-center align-middle">
            <th></th>
            <th scope="col" class="col-4">Название сигнала</th>
            @if ($CP->type != "ТП")
                <th scope="col" class="col-1">Клемма КП-М (ПС)</th>
            @endif
            <th scope="col" @if ($CP->type != "ТП") class="col-1" @else class="col-2" @endif>№ ТУ</th>
            <th scope="col" class="col-4">Оперативное название сигнала</th>
            <th scope="col" @if ($CP->type != "ТП") class="col-1" @else class="col-2" @endif>Соответствие сигнала с ДП</th>
        </tr>
        </thead>
        <tbody>
            <button type="button" name="addTY" id="addTY" class="btn btn-success">Добавить строку</button>
            @foreach ($TY as $ty)
            <tr class="text-center">
                <td></td>
                <td><input class="w-100" type="text" name="{{ Str::of('name')->append($ty->id)->append('TY') }}" value="{{ $ty->name }}"></td>
                @if ($CP->type != "ТП")
                    <td><input class="w-100" type="text" name="{{ Str::of('klemm')->append($ty->id)->append('TY') }}" value="{{ $ty->klemm }}"></td>
                @endif
                <td><input class="w-100" type="text" name="{{ Str::of('number')->append($ty->id)->append('TY') }}" value="{{ $ty->number }}"></td>
                <td><input class="w-100" type="text" name="{{ Str::of('oper')->append($ty->id)->append('TY') }}" value="{{ $ty->oper }}"></td>
                <td><input class="w-100" type="text" name="{{ Str::of('DP')->append($ty->id)->append('TY') }}" value="{{ $ty->DP }}"></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        let j = @json($ty->id);
        $('#TYCount').val(j);
        $( '#addTY' ).click(function(){
            ++j;
            $("#TYtable").append(`<tr class="text-center"><td class="removeTY"><div>X</div></td><td><input class="w-100" type="text" name="{{ Str::of('name')->append('${j}')->append('TY') }}"></td><td><input class="w-100" type="text" name="{{ Str::of('klemm')->append('${j}')->append('TY') }}"></td> @if ($CP->type != "ТП")<td><input class="w-100" type="text" name="{{ Str::of('number')->append('${j}')->append('TY') }}"></td>@endif <td><input class="w-100" type="text" name="{{ Str::of('oper')->append('${j}')->append('TY') }}"></td><td><input class="w-100" type="text" name="{{ Str::of('DP')->append('${j}')->append('TY') }}"></td></tr>`);
            $('#TYCount').val(j);
        });

        $(document).on('click', '.removeTY', function(){
            $(this).parents('tr').remove();
            $('#TYCount').val(--j);
        });
    </script>
    <button type="submit" class="btn btn-primary">Изменить</button>
</form>
@endsection

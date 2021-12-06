@extends('layouts.main')

@section('content')

<div class="col-12 mt-5">
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
                <th scope="col" class="col">Название сигнала</th>
                @if ($CP->type != "ТП")
                    <th scope="col" class="col-1">Клемма КП-М (ПС)</th>
                @endif
                <th scope="col" @if ($CP->type != "ТП") class="col-1" @else class="col-2" @endif>№ ТС</th>
                @if ($CP->type != "ТП")
                    <th scope="col" class="col-1">Инверсия в настройке</th>
                @endif
                <th scope="col" class="col">Оперативное название сигнала</th>
                <th scope="col" @if ($CP->type != "ТП") class="col-1" @else class="col-2" @endif>Соответствие сигнала с ДП</th>
            </tr>
            </thead>
            <tbody>
                <button type="button" name="addTC" id="addTC" class="btn btn-warning">Добавить строку</button>
                @foreach ($TC as $tc)
                <tr class="text-center">
                    <td><div class="fw-bold lh-lg" style="color: rgb(175, 175, 175)">X</div></td>
                    <td><input class="w-100" type="text" name="{{ Str::of('name')->append($tc->id)->append('TC') }}" value="{{ $tc->name }}" required></td>
                    @if ($CP->type != "ТП")
                        <td><input class="w-100" type="text" name="{{ Str::of('klemm')->append($tc->id)->append('TC') }}" value="{{ $tc->klemm }}" required></td>
                    @endif
                    <td><input class="w-100" type="text" name="{{ Str::of('number')->append($tc->id)->append('TC') }}" value="{{ $tc->number }}" required></td>
                    @if ($CP->type != "ТП")
                        <td><input class="w-100" type="text" name="{{ Str::of('invert')->append($tc->id)->append('TC') }}" value="{{ $tc->invert }}" required></td>
                    @endif
                    <td><input class="w-100" type="text" name="{{ Str::of('oper')->append($tc->id)->append('TC') }}" value="{{ $tc->oper }}" required></td>
                    <td><input class="w-100" type="text" name="{{ Str::of('DP')->append($tc->id)->append('TC') }}" value="{{ $tc->DP }}" required></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <script>
            let i = @json($tc->id);
            $('#TCCount').val(i);
            $( '#addTC' ).click(function(){
                ++i;
                $("#TCtable").append(`<tr class="text-center"><td class="removeTC"><div class="fw-bold lh-lg">X</div></td><td><input class="w-100" type="text" name="{{ Str::of('name')->append('${i}')->append('TC') }}" required></td> @if ($CP->type != "ТП") <td><input class="w-100" type="text" name="{{ Str::of('klemm')->append('${i}')->append('TC') }}" required></td> @endif <td><input class="w-100" type="text" name="{{ Str::of('number')->append('${i}')->append('TC') }}" required></td> @if ($CP->type != "ТП") <td><input class="w-100" type="text" name="{{ Str::of('invert')->append('${i}')->append('TC') }}" required></td> @endif <td><input class="w-100" type="text" name="{{ Str::of('oper')->append('${i}')->append('TC') }}" required></td><td><input class="w-100" type="text" name="{{ Str::of('DP')->append('${i}')->append('TC') }}" required></td></tr>`);
                $('#TCCount').val(i);
            });

            $(document).on('click', '.removeTC', function(){
                $(this).parents('tr').remove();
            });
        </script>

        <table class="table table-bordered table-sm table-fixed mb-5" id="TYtable">
            <thead>
            <tr class="text-center align-middle">
                <th></th>
                <th scope="col" class="col">Название сигнала</th>
                @if ($CP->type != "ТП")
                    <th scope="col" class="col-2">Клемма КП-М (ПС)</th>
                @endif
                <th scope="col" @if ($CP->type != "ТП") class="col-1" @else class="col-2" @endif>№ ТУ</th>
                <th scope="col" class="col">Оперативное название сигнала</th>
                <th scope="col" @if ($CP->type != "ТП") class="col-1" @else class="col-2" @endif>Соответствие сигнала с ДП</th>
            </tr>
            </thead>
            <tbody>
                <button type="button" name="addTY" id="addTY" class="btn btn-warning">Добавить строку</button>
                @foreach ($TY as $ty)
                <tr class="text-center">
                    <td><div class="fw-bold lh-lg" style="color: rgb(175, 175, 175)">X</div></td>
                    <td><input class="w-100" type="text" name="{{ Str::of('name')->append($ty->id)->append('TY') }}" value="{{ $ty->name }}" required></td>
                    @if ($CP->type != "ТП")
                        <td><input class="w-100" type="text" name="{{ Str::of('klemm')->append($ty->id)->append('TY') }}" value="{{ $ty->klemm }}" required></td>
                    @endif
                    <td><input class="w-100" type="text" name="{{ Str::of('number')->append($ty->id)->append('TY') }}" value="{{ $ty->number }}" required></td>
                    <td><input class="w-100" type="text" name="{{ Str::of('oper')->append($ty->id)->append('TY') }}" value="{{ $ty->oper }}" required></td>
                    <td><input class="w-100" type="text" name="{{ Str::of('DP')->append($ty->id)->append('TY') }}" value="{{ $ty->DP }}" required></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <script>
            let j = @json($ty->id);
            $('#TYCount').val(j);
            $( '#addTY' ).click(function(){
                ++j;
                $("#TYtable").append(`<tr class="text-center"><td class="removeTY"><div class="fw-bold lh-lg">X</div></td><td><input class="w-100" type="text" name="{{ Str::of('name')->append('${j}')->append('TY') }}" required></td> @if ($CP->type != "ТП") <td><input class="w-100" type="text" name="{{ Str::of('klemm')->append('${j}')->append('TY') }}" required></td> @endif <td><input class="w-100" type="text" name="{{ Str::of('number')->append('${j}')->append('TY') }}" required></td><td><input class="w-100" type="text" name="{{ Str::of('oper')->append('${j}')->append('TY') }}" required></td><td><input class="w-100" type="text" name="{{ Str::of('DP')->append('${j}')->append('TY') }}" required></td></tr>`);
                $('#TYCount').val(j);
            });

            $(document).on('click', '.removeTY', function(){
                $(this).parents('tr').remove();
            });
        </script>

        <button type="submit" class="mb-5 btn btn-lg btn-success">Сохранить изменения</button>
    </form>
</div>
@endsection

@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('signals.update', ['signal' => $CP]) }}">
    @method('PUT')
    @csrf
    <input type="hidden" name="CP" value="{{ $CP }}">
    <table class="table table-bordered table-sm mb-5">
        <thead class="text-center align-middle">
        <tr>
            <th scope="col">Название сигнала</th>
            <th scope="col">Клемма КП-М (ПС)</th>
            <th scope="col">№ ТС</th>
            <th scope="col">Инверсия в настройке</th>
            <th scope="col">Оперативное название сигнала</th>
            <th scope="col">Соответствие сигнала с ДП</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($TC as $tc)
            <tr class="text-center">
                <td><input type="text" name="{{ Str::of('name')->append($tc->id)->append('TC') }}" value="{{ $tc->name }}"></td>
                <td><input type="text" name="{{ Str::of('klemm')->append($tc->id)->append('TC') }}" value="{{ $tc->klemm }}"></td>
                <td><input type="text" name="{{ Str::of('number')->append($tc->id)->append('TC') }}" value="{{ $tc->number }}"></td>
                <td><input type="text" name="{{ Str::of('invert')->append($tc->id)->append('TC') }}" value="{{ $tc->invert }}"></td>
                <td><input type="text" name="{{ Str::of('oper')->append($tc->id)->append('TC') }}" value="{{ $tc->oper }}"></td>
                <td><input type="text" name="{{ Str::of('DP')->append($tc->id)->append('TC') }}" value="{{ $tc->DP }}"></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="table table-bordered table-sm table-fixed">
        <thead>
        <tr class="text-center align-middle">
            <th scope="col">Название сигнала</th>
            <th scope="col">Клемма КП-М (ПС)</th>
            <th scope="col">№ ТУ</th>
            <th scope="col">Оперативное название сигнала</th>
            <th scope="col">Соответствие сигнала с ДП</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($TY as $ty)
            <tr class="text-center">
                <td><input type="text" name="{{ Str::of('name')->append($ty->id)->append('TY') }}" value="{{ $ty->name }}"></td>
                <td><input type="text" name="{{ Str::of('klemm')->append($ty->id)->append('TY') }}" value="{{ $ty->klemm }}"></td>
                <td><input type="text" name="{{ Str::of('number')->append($ty->id)->append('TY') }}" value="{{ $ty->number }}"></td>
                <td><input type="text" name="{{ Str::of('oper')->append($ty->id)->append('TY') }}" value="{{ $ty->oper }}"></td>
                <td><input type="text" name="{{ Str::of('DP')->append($ty->id)->append('TY') }}" value="{{ $ty->DP }}"></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <button type="submit" class="btn btn-primary">Изменить</button>
</form>
@endsection

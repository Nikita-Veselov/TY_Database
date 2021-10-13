@extends('layouts.main')

@section('content')

    @if ($TC->isEmpty())

        <div class="row text-center">
            <div class="col fs-3">{{ $CP->name }}</div>
            <div class="col-12">Сигналы не добавлены</div>
            <div class="col-12 text-center">
                <a type="button" class="btn btn-primary col-6" href="{{ route('signals.create', ['CP' => $CP->code]) }}" role="button">Создать</a>
            </div>
        </div>

    @else

        <div class="col-12 text-center pb-2">
            <div class="col fs-3">{{ $CP->name }}</div>
            <a type="button" class="btn btn-primary col-6" href="{{ route('signals.edit', ['signal'=> $CP->code, 'CP' => $CP->code]) }}" role="button">Изменить</a>
        </div>

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
                    <td class="text-start col-3">{{ $tc->name }}</td>
                    <td class="col-1">{{ $tc->klemm }}</td>
                    <td class="col-1">{{ $tc->number }}</td>
                    <td class="col-1">{{ $tc->invert }}</td>
                    <td class="col-3">{{ $tc->oper }}</td>
                    <td class="col-3">{{ $tc->DP }}</td>
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
                    <td class="text-start col-3">{{ $ty->name }}</td>
                    <td class="col-2">{{ $ty->klemm }}</td>
                    <td class="col-1">{{ $ty->number }}</td>
                    <td class="col-3">{{ $ty->oper }}</td>
                    <td class="col-3">{{ $ty->DP }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    @endif
@endsection

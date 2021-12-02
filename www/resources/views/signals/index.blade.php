@extends('layouts.main')

@section('content')

<div class="col-10">
    @if ($TC->isEmpty() & $TY->isEmpty())
        <div class="row text-center pt-5">
            <div class="col fs-3">{{ $CP->name }}</div>
            <div class="col-12">Сигналы не добавлены</div>
            @if (Auth::check())
                <div class="col-12 text-center">
                    <a type="button" class="btn btn-primary col-6" href="{{ route('signals.create', ['CP' => $CP->code]) }}" role="button">Создать</a>
                </div>
            @endif
        </div>
    @else

        <div class="col-12 text-center py-4">
            <div class="col fs-3 pb-4">№{{ $CP->code }} - {{ $CP->type }} {{ $CP->name }}</div>
            <div class="button-group">
                @if (Auth::check())
                    <a class="btn btn-success col-4" href="{{ route('signals.edit', ['signal'=> $CP->code, 'CP' => $CP->code]) }}" role="button">Изменить</a>
                @endif
                <a class="btn btn-warning col-4" href="{{ route('print', ['CP'=> $CP->code]) }}" role="button">Печать</a>
            </div>
        </div>

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
                @if (Auth::check())
                    <th scope="col" class="col-1"></th>
                @endif
            </tr>
            </thead>
            <tbody class="text-center align-middle">
                @foreach ($TC as $tc)
                <tr>
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
                    @if (Auth::check())
                        <td>
                            <form class="delete" action="{{ route('signals.destroy', $tc->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="CP" value="{{ $CP->code }}">
                                <input type="hidden" name="sig" value="TC">
                                <input type="hidden" name="id" value="{{ $tc->id }}">
                                <button type="submit" class="btn btn-danger col">Уд.</button>
                            </form>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="table table-bordered table-sm table-fixed">
            <thead>
            <tr class="text-center align-middle">
                <th scope="col" class="col-4">Название сигнала</th>
                @if ($CP->type != "ТП")
                    <th scope="col" class="col-2">Клемма КП-М (ПС)</th>
                @endif
                <th scope="col" class="col-1">№ ТУ</th>
                <th scope="col" class="col-3">Оперативное название сигнала</th>
                <th scope="col" class="col-1">Соответствие сигнала с ДП</th>
                @if (Auth::check())
                    <th scope="col" class="col-1"></th>
                @endif
            </tr>
            </thead>
            <tbody>
                @foreach ($TY as $ty)
                <tr class="text-center align-middle">
                    <td>{{ $ty->name }}</td>
                    @if ($CP->type != "ТП")
                        <td>{{ $ty->klemm }}</td>
                    @endif
                    <td>{{ $ty->number }}</td>
                    <td>{{ $ty->oper }}</td>
                    <td>{{ $ty->DP }}</td>
                    @if (Auth::check())
                        <td>
                            <form class="delete" action="{{ route('signals.destroy', $ty->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="CP" value="{{ $CP->code }}">
                                <input type="hidden" name="sig" value="TY">
                                <input type="hidden" name="id" value="{{ $ty->id }}">
                                <button type="submit" class="btn btn-danger col delete">Уд.</button>
                            </form>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@if ($print)
    <script>
        w = window.open( '../tmp/print.pdf' );
        w.print();
    </script>
@endif


@endsection

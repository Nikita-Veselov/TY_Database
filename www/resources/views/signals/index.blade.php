@extends('layouts.main')

@section('content')

    @if ($TC->isEmpty() & $TY->isEmpty())

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
                @if ($CP->type != "ТП")
                    <th scope="col">Клемма КП-М (ПС)</th>
                @endif
                <th scope="col">№ ТС</th>
                @if ($CP->type != "ТП")
                    <th scope="col">Инверсия в настройке</th>
                @endif
                <th scope="col">Оперативное название сигнала</th>
                <th scope="col">Соответствие сигнала с ДП</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($TC as $tc)
                <tr class="text-center">
                    <td class="text-start col-3">{{ $tc->name }}</td>
                    @if ($CP->type != "ТП")
                        <td class="col-1">{{ $tc->klemm }}</td>
                    @endif
                    <td class="col-1">{{ $tc->number }}</td>
                    @if ($CP->type != "ТП")
                        <td class="col-1">{{ $tc->invert }}</td>
                    @endif
                    <td class="col-3">{{ $tc->oper }}</td>
                    <td class="col-3">{{ $tc->DP }}</td>
                    <td>
                        <form action="{{ route('signals.destroy', $tc->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="CP" value="{{ $CP->code }}">
                            <input type="hidden" name="sig" value="TC">
                            <input type="hidden" name="id" value="{{ $tc->id }}">
                            <button type="submit" class="btn btn-danger col">Уд.</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="table table-bordered table-sm table-fixed">
            <thead>
              <tr class="text-center align-middle">
                <th scope="col">Название сигнала</th>
                @if ($CP->type != "ТП")
                    <th scope="col">Клемма КП-М (ПС)</th>
                @endif
                <th scope="col">№ ТУ</th>
                <th scope="col">Оперативное название сигнала</th>
                <th scope="col">Соответствие сигнала с ДП</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($TY as $ty)
                <tr class="text-center">
                    <td class="text-start col-3">{{ $ty->name }}</td>
                    @if ($CP->type != "ТП")
                        <td class="col-2">{{ $ty->klemm }}</td>
                    @endif
                    <td class="col-1">{{ $ty->number }}</td>
                    <td class="col-3">{{ $ty->oper }}</td>
                    <td class="col-3">{{ $ty->DP }}</td>
                    <td>
                        <form action="{{ route('signals.destroy', $ty->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="CP" value="{{ $CP->code }}">
                            <input type="hidden" name="sig" value="TY">
                            <input type="hidden" name="id" value="{{ $ty->id }}">
                            <button type="submit" class="btn btn-danger col">Del</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    @endif
@endsection

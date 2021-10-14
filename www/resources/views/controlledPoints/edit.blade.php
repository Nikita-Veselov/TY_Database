@extends('layouts.main')

@section('content')

<div class="col-6">
    <form method="POST" action="{{ route('controlledPoints.update', ['controlledPoint' => $controlledPoint->id]) }}">
        @method('PUT')
        @csrf
        <div class="row mb-3">
            <label for="Код" class="col-sm-2 col-form-label">Код</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="code" value="{{ $controlledPoint->code }}">
            </div>
        </div>

        <div class="row mb-3">
            <select class="form-select" aria-label="Должность" name="type" value="{{ $controlledPoint->type }}">
                <option value="{{ $key1 = 'Станция' }}"
                    @if ($key1 == $controlledPoint->type ) selected @endif
                    >Станция
                </option>
                <option value="{{ $key2 = 'ПС' }}"
                    @if ($key2 == $controlledPoint->type ) selected @endif
                    >ПС
                </option>
                <option value="{{ $key3 = 'ТП' }}"
                    @if ($key3 == $controlledPoint->type ) selected @endif
                    >ТП
                </option>
                <option value="{{ $key4 = 'ПГ' }}"
                    @if ($key4 == $controlledPoint->type ) selected @endif
                    >ПГ
                </option>
                <option value="{{ $key5 = 'ЦРП' }}"
                    @if ($key5 == $controlledPoint->type ) selected @endif
                    >ЦРП
                </option>
            </select>
        </div>

        <div class="row mb-3">
        <label for="Код" class="col-sm-2 col-form-label">Название</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="Код" name="name" value="{{ $controlledPoint->name }}">
        </div>
        </div>

        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
</div>
@endsection

@extends('layouts.main')

@section('content')

<div class="col-6">
    <form method="POST" action="{{ route('controlledPoints.update', ['controlledPoint' => $controlledPoint->id]) }}">
        @method('PUT')
        @csrf
        <div class="row mb-3">
            <label for="Код" class="col-sm-2 col-form-label">Код</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="Код" name="code" value="{{ $controlledPoint->code }}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="Тип" class="col-sm-2 col-form-label">Тип</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="Тип" name="type" value="{{ $controlledPoint->type }}">
            </div>
        </div>

        <div class="row mb-3">
        <label for="Код" class="col-sm-2 col-form-label">Название</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="Код" name="name" value="{{ $controlledPoint->name }}">
        </div>
        </div>

        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
</div>
@endsection

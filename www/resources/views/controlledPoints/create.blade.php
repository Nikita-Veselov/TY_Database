@extends('layouts.main')

@section('content')

<form method="POST" action="{{ url('controlledPoints') }}">
    @csrf
    <div class="row mb-3">
        <label for="Код" class="col-sm-2 col-form-label">Код</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Код" name="code" value="{{ old('code') }}">
        </div>
    </div>

    <div class="row mb-3">
        <select class="form-select" aria-label="Должность" name="type" value="{{ old('type') }}">
            <option value="" selected disabled>Тип</option>
            <option value="Станция">Станция</option>
            <option value="ПС">ПС</option>
            <option value="ТП">ТП</option>
            <option value="ПГ">ПГ</option>
            <option value="ЦРП">ЦРП</option>
        </select>
    </div>

    <div class="row mb-3">
      <label for="Код" class="col-sm-2 col-form-label">Название</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="Код" name="name" value="{{ old('name') }}">
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Создать</button>
  </form>

@endsection

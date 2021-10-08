@extends('layouts.main')

@section('content')

@foreach ($errors->all() as $message)
    <div class="alert alert-danger" role="alert">
        {{ $message }}
     </div>
@endforeach

<form method="POST" action="{{ url('workers') }}">
    @csrf
    <div class="row mb-3">
        <label for="Фамилия" class="col-sm-2 col-form-label">Фамилия</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Фамилия" name="name1" value="{{ old('name1') }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Имя" class="col-sm-2 col-form-label">Имя</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Имя" name="name2" value="{{ old('name2') }}">
        </div>
    </div>

    <div class="row mb-3">
      <label for="Отчество" class="col-sm-2 col-form-label">Отчество</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="Отчество" name="name3" value="{{ old('name3') }}">
      </div>
    </div>

    <div class="row mb-3">
        <select class="form-select" aria-label="Должность" name="position" value="{{ old('position') }}">
            <option value="" selected disabled>Должность</option>
            <option value="эл.мех.">Электромеханик</option>
            <option value="ст.эл.мех.">Старший электромеханик</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Создать</button>
  </form>

@endsection

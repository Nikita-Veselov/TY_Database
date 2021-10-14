@extends('layouts.main')

@section('content')

@php
    $arr = explode(' ', $worker->BIO);
    $worker->name1 = $arr[0];
    $worker->name2 = $arr[1];
    $worker->name3 = $arr[2];
@endphp


<form method="POST" action="{{ route('workers.update', ['worker' => $worker->id]) }}">
    @method('PUT')
    @csrf
    <div class="row mb-3">
        <label for="Фамилия" class="col-sm-2 col-form-label">Фамилия</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Фамилия" name="name1" value="{{ $worker->name1 }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Имя" class="col-sm-2 col-form-label">Имя</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="Имя" name="name2" value="{{ $worker->name2 }}">
        </div>
    </div>

    <div class="row mb-3">
      <label for="Отчество" class="col-sm-2 col-form-label">Отчество</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="Отчество" name="name3" value="{{ $worker->name3 }}">
      </div>
    </div>

    <div class="row mb-3">
        <select class="form-select" aria-label="Должность" name="position">
            <option value="" disabled>Должность</option>
            <option value="{{ $key1 = 'эл.мех.' }}"
                @if ($key1 == $worker->position ) selected @endif
                >Электромеханик
            </option>
            <option value="{{ $key2 = 'ст.эл.мех.' }}"
                @if ($key2 == $worker->position ) selected @endif
                >Старший электромеханик
            </option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Создать</button>
  </form>

@endsection

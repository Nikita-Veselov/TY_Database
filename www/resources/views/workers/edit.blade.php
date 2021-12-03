@extends('layouts.main')

@section('content')

@php
    $arr = explode(' ', $worker->BIO);
    $worker->name1 = $arr[0];
    $worker->name2 = $arr[1];
    $worker->name3 = $arr[2];
@endphp

<div class="col-8 mt-5">
    <form method="POST" action="{{ route('workers.update', ['worker' => $worker->id]) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row justify-content-center">

            <div class="col text-center fs-4">Изменение работника:</div>

            <div class="w-100"></div>

            <div class="col-4 my-4 form-floating ">
                <input type="text" class="form-control" id="Фамилия" name="name1" value="{{ $worker->name1 }}" placeholder="floating label enabler" required>
                <label for="Номер" class="px-4">Фамилия</label>
            </div>

            <div class="col-4 my-4 form-floating ">
                <input type="text" class="form-control" id="Имя" name="name2" value="{{ $worker->name2 }}" placeholder="floating label enabler" required>
                <label for="Номер" class="px-4">Имя</label>
            </div>

            <div class="col-4 my-4 form-floating ">
                <input type="text" class="form-control" id="Отчество" name="name3" value="{{ $worker->name3 }}" placeholder="floating label enabler" required>
                <label for="Номер" class="px-4">Отчество</label>
            </div>

            <div class="w-100"></div>

            <div class="col-6 my-4">
                <select class="form-select form-floating" name="position" value="{{ $worker->position }}" required>
                    <option value="" selected disabled>Должность</option>
                    <option value="{{ $type = 'Электромеханик'}}" @if ( $type == $worker->position)) ? selected @endif>Электромеханик</option>
                    <option value="{{ $type = 'Старший электромеханик'}}" @if ( $type == $worker->position) ? selected @endif>Старший электромеханик</option>
                    <option value="{{ $type = 'Начальник РРУ'}}" @if ( $type == $worker->position) ? selected @endif>Начальник РРУ</option>
                </select>
            </div>

            <div class="w-100"></div>

            <div class="col-6 my-4">
                <label for="signature">Подпись</label>
                <input type="file" class="form-control" id="signature" name="signature" accept=".png">
            </div>

            <div class="w-100"></div>

            <button type="submit" class="col-4 btn btn-primary">Изменить</button>
        </div>
    </form>
</div>
@endsection

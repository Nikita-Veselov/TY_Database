@extends('layouts.main')

@section('content')

<div class="col-8 mt-5">
    <form method="POST" action="{{ url('devices') }}">
        @csrf
        <div class="row justify-content-center">

            <div class="col text-center fs-4">Добавление устройства:</div>

            <div class="w-100"></div>

            <div class="col-6 my-4 form-floating ">
                <input type="text" class="form-control" id="Код" name="code" value="{{ old('code') }}" placeholder="floating label enabler" required>
                <label for="Номер" class="px-4">Код</label>
            </div>

            <div class="w-100"></div>

            <div class="col-6 my-4 form-floating">
                <input type="text" class="form-control"  id="Название" name="name" value="{{ old('name') }}" placeholder="floating label enabler" required>
                <label for="Напряжение ТС" class="px-4">Название</label>
            </div>

            <div class="w-100"></div>

            <div class="col-6 my-4 form-floating ">
                <input type="text" class="form-control" id="Класс точности" name="class" value="{{ old('class') }}" placeholder="floating label enabler" required>
                <label for="Номер" class="px-4">Класс точности</label>
            </div>

            <div class="w-100"></div>

            <div class="col-6 my-4 form-floating ">
                <input type="text" class="form-control" id="Дата" name="date" value="{{ old('date') }}" placeholder="floating label enabler" required>
                <label for="Номер" class="px-4">Дата</label>
            </div>

            <div class="w-100"></div>

            <button type="submit" class="col-4 btn btn-primary">Создать</button>
        </div>
    </form>
</div>

@endsection

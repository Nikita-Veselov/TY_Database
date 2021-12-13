@extends('layouts.main')

@section('content')

<div class="col-8 mt-5">
    <form method="POST" action="{{ url('controlledPoints') }}">
        @csrf
        <div class="row justify-content-center">

            <div class="col text-center fs-4">Добавление КП:</div>

            <div class="w-100"></div>

            <div class="col-6 my-4 form-floating ">
                <input type="text" class="form-control" id="Код" name="code" value="{{ old('code') }}" placeholder="floating label enabler" required>
                <label for="Номер" class="px-4">Код</label>
            </div>

            <div class="w-100"></div>

            <div class="col-6 my-4">
                <select class="form-select form-floating" name="type" value="{{ old('type') }}" required>
                    <option value="" selected disabled>Тип</option>
                    <option value="{{ $type = 'Станция'}}" @if ( $type == old('type')) ? selected @endif>Станция</option>
                    <option value="{{ $type = 'ПСК'}}" @if ( $type == old('type')) ? selected @endif>ПСК</option>
                    <option value="{{ $type = 'ППС'}}" @if ( $type == old('type')) ? selected @endif>ППС</option>
                    <option value="{{ $type = 'ТП'}}" @if ( $type == old('type')) ? selected @endif>ТП</option>
                    <option value="{{ $type = 'ПГ'}}" @if ( $type == old('type')) ? selected @endif>ПГ</option>
                    <option value="{{ $type = 'ЦРП'}}" @if ( $type == old('type')) ? selected @endif>ЦРП</option>
                </select>
            </div>

            <div class="w-100"></div>

            <div class="col-6 my-4 form-floating">
                <input type="text" class="form-control"  id="Название" name="name" value="{{ old('name') }}" placeholder="floating label enabler" required>
                <label for="Напряжение ТС" class="px-4">Название</label>
            </div>

            <div class="w-100"></div>

            <button type="submit" class="col-4 btn btn-primary">Создать</button>
        </div>
    </form>
</div>

@endsection

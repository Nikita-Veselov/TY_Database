@extends('layouts.main')

@section('content')

<div class="row justify-content-center">
    <div class="col-6 border">
        <form action="{{ route('auth') }}" method="POST">
            @csrf
            @method('POST')
            <div class="m-3">
                <label for="login" class="form-label">Введите логин:</label>
                <input type="text" class="form-control" name="login" placeholder="Логин">
            </div>

            <div class="m-3">
                <label for="exampleFormControlInput1" class="form-label">Введите пароль:</label>
                <input type="password" class="form-control" name="password" placeholder="Пароль">
            </div>

            <button class="m-3 btn btn-outline-primary" type="submit">Вход</button>
        </form>
    </div>
</div>


@endsection

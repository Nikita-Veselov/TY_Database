
@extends('layouts.main')

@section('content')
    <div class="container vh-100">
        <div class="header row text-center">
            <div class="">Title</div>
            <div class="">Subtitle</div>
        </div>

        <div class="row justify-content-center">
            <a class="col-4 btn btn-primary" href="/create" role="button">Создать</a>
            <a class="col-4 btn btn-secondary" href="#" role="button">Найти</a>
        </div>

        <div class="footer row text-center">
            <div class="">Footer</div>
        </div>
    </div>
@endsection

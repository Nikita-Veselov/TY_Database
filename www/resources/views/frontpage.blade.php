
@extends('layouts.main')

@section('content')
    <div class="container vh-100">
        <div class="header row">
            <div class="tw-text-center tw-text-3xl">Title</div>
            <div class="col tw-text-center tw-text-sm">Subtitle</div>
        </div>

        <div class="row">
            <div class="d-grid gap-2 col-6 mx-auto">
                <a class="btn btn-primary" href="/create" role="button">Создать</a>
                <a class="btn btn-secondary" href="#" role="button">Найти</a>
            </div>
        </div>

        <div class="footer row">
            <div class="tw-text-center">Footer</div>
        </div>
    </div>
@endsection

<div>
    <div class="header row text-start">
        <div class="col-6 pt-4">
            @if (!Request::is('/'))
                    <a class="col-2 btn btn-outline-warning" href="/" role="button">Домой</a>
                @if (Request::is('records'))
                    <a class="col-2 btn btn-outline-success" href="/" role="button">Назад</a>
                    @else
                        @if (Request::is('records/*'))
                            <a class="col-2 btn btn-success" href="{{ route('records.index') }}" role="button">Назад</a>
                        @else
                        <a class="col-2 btn btn-success" href="javascript:history.back()" role="button">Назад</a>
                    @endif
                @endif
            @endif
        </div>
        <div class="col-6 text-end">
            <div class="fs-3">Телемеханика</div>
            <div class="fs-6">База данных</div>
        </div>
        <div style="height: 4rem;">
            <div class="row justify-content-center">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger text-center col-3">{{ $error }}</div>
                    @endforeach
                @endif

                @if (Session::has('success'))
                    <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
                @endif
            </div>
        </div>

    </div>
</div>

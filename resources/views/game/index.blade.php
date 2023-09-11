@extends("layouts.index")
@section('title', 'Главное меню')
@section('content')
    <div class="board-container">
        <div class="col-md-8 game-info">
            @include('game/board')
        </div>


        <div class="col-md-3">
            <div class="control-panel text-center action-menu">
                <p>Управление</p>
                <button data-action="move" name="left" class="btn btn-primary button-control" type="button">Влево
                </button>
                <button data-action="move" name="up" class="btn btn-primary button-control" type="button">Вверх</button>
                <button data-action="move" name="right" class="btn btn-primary button-control" type="button">Вправо
                </button>
                <button data-action="move" name="down" class="btn btn-primary button-control" type="button">Вниз
                </button>
                <button disabled data-action="battle" name="hit" class="btn btn-danger button-control" type="button">Удар
                </button>
            </div>
        </div>

        <div>
            {{$text ?? ''}}
        </div>
    </div>
@endsection

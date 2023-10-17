@extends("layouts.index")
@section('title', 'Главное меню')
@section('content')
    <div class="menu main-menu action-menu text-center">
        <p>Добро пожаловать!</p>
        <button name="game" class="btn btn-primary" data-action="start" type="button">Начать обычную игру</button>
        <button name="survive" class="btn btn-primary" data-action="start" type="button">Начать игру на выживание</button>
    </div>
@endsection

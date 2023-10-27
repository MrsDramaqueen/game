@extends("layouts.index")
@section('title', 'Главное меню')
@section('content')
    <div class="menu main-menu action-menu text-center">
        <p>Добро пожаловать!</p>
        <form action="game" method="get">
            <p><label>
                    <select size="3" name="game[]">
                            <option disabled>Выберите режим игры</option>
                            <option value="normal">Начать обычную игру</option>
                            <option value="survive">Начать игру на выживание</option>
                    </select>
                </label></p>
            <p><input type="submit" value="Начать игру"></p>
        </form>
    </div>
@endsection

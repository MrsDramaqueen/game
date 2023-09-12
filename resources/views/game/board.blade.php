<div class="player-information text-left">
    <player-info class="player-info">HP: {{$player->getHp()}}</player-info                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              >
    <p class="player-info">Damage: {{$player->getDamage()}}</p>
    <p class="player-info">Level: {{$player->getLevel()}}</p>
    <p class="player-info">Exp: {{$player->getExp()}}</p>
    <p class="player-info">Mana: {{$player->getMana()}}</p>
</div>

<div class="row">
    <div>
        <div class="panel-body">
            <table class="table table-bordered board">
                <tbody>
                @for($i = 1; $i <= $board->getHeight(); $i++)
                    <tr>
                        @for($j = 1; $j <= $board->getWidth(); $j++)
                            @php
                                $class = '';
                                $inner = url('/web/image/travas.png');;
                            @endphp
                            @if($player->getPositionWidth() == $j && $player->getPositionHeight() == $i)
                                @php
                                    $class = 'player';
                                    $inner = url('/web/image/pers3s.png');
                                @endphp
                            @endif
                            @foreach($monsters as $monster)
                                @if($monster->getPositionWidth() == $j && $monster->getPositionHeight() == $i)
                                    @php
                                        $class = 'monster';
                                        if ($monster->getType() == \App\Models\Monster::GOBLIN_TYPE) {
                                            $inner = url('/web/image/goblin.png');
                                        } else {
                                            $inner = url('/web/image/circle.png');
                                         }
                                    @endphp
                                @endif
                            @endforeach
                            @foreach($obstacles as $obstacle)
                                @if($obstacle->getPositionWidth() == $j && $obstacle->getPositionHeight() == $i)
                                    @php
                                        $class = '$obstacle';
                                        if ($obstacle->getType() == \App\Models\Obstacle::STONE_TYPE) {
                                            $inner = url('/web/image/stone.jpg');
                                        } else {
                                            $inner = url('/web/image/fire.png');
                                         }
                                    @endphp
                                @endif
                            @endforeach
                            <td class="board-elem {{$class}}">
                                <p><img src="{{$inner}}" alt="u"></p>
                            </td>
                        @endfor
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>

</div>


@foreach($monsters as $monster)
    <div class="player-information text-left">
        <player-info class="player-info">HP: {{$monster->getHp()}}</player-info                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              >
        <p class="player-info">Damage: {{$monster->getDamage()}}</p>
        <p class="player-info">Fraction: {{$monster->getType()}}</p>
        <p class="player-info">Mana: {{$monster->getMana()}}</p>
    </div>
@endforeach


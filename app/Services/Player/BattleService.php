<?php

namespace App\Services\Player;

use App\Entity\Characters;
use App\Entity\Monster\ListMonsters;
use App\Entity\Player\Player;
use App\Services\Player\Commands\BattleCommands\Hill;
use App\Services\Player\Commands\BattleCommands\Hit;

class BattleService
{
    const BATTLE_ACTION_HIT = 'hit';
    const BATTLE_ACTION_HILL = 'hill';

    //TODO: Можно добавить команду оглушения - меньше урона, но противник не может ходить 1 ход
    public static function getBattleCommand($command, Characters $characters, $monster): mixed
    {
        //TODO: Добавить другие виды ударов, убрать в другое место хилл
        $cart = [
            self::BATTLE_ACTION_HIT => new Hit($characters, $monster),
            self::BATTLE_ACTION_HILL => new Hill($characters),
        ];

        return $cart[$command];
    }
}

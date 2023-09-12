<?php

namespace App\Services\Player;

use App\Entity\Player\Player;
use App\Services\Player\Commands\BattleCommands\Hill;
use App\Services\Player\Commands\BattleCommands\Hit;

class BattleService
{
    const BATTLE_ACTION_HIT = 'hit';
    const BATTLE_ACTION_HILL = 'hill';

    public static function getBattleCommand($command, Player $player): mixed
    {
        $cart = [
            self::BATTLE_ACTION_HIT => new Hit($player),
            self::BATTLE_ACTION_HILL => new Hill($player),
        ];

        //dd($command);
        return $cart[$command];
    }
}

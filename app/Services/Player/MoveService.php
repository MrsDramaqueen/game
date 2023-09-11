<?php

namespace App\Services\Player;

use App\Entity\Player\Player;
use App\Services\Player\Commands\Down;
use App\Services\Player\Commands\Left;
use App\Services\Player\Commands\Right;
use App\Services\Player\Commands\Up;

class MoveService
{
    const MOVE_LEFT = 'left';
    const MOVE_RIGHT = 'right';
    const MOVE_UP = 'up';
    const MOVE_DOWN = 'down';

    /**
     * @param $command
     * @param Player $player
     * @return mixed
     */
    public static function getMoveCommand($command, Player $player): mixed
    {
        $cart = [
            self::MOVE_LEFT => new Left($player),
            self::MOVE_RIGHT => new Right($player),
            self::MOVE_UP => new Up($player),
            self::MOVE_DOWN => new Down($player)
        ];

        //dd($command);
        return $cart[$command];
    }
}

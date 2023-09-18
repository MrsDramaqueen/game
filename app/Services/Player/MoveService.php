<?php

namespace App\Services\Player;

use App\Entity\Characters;
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
     * @param Characters $characters
     * @return mixed
     */
    public static function getMoveCommand(string $command, Characters $characters): mixed
    {
        return match ($command) {
            self::MOVE_LEFT => new Left($characters),
            self::MOVE_RIGHT => new Right($characters),
            self::MOVE_UP => new Up($characters),
            self::MOVE_DOWN => new Down($characters),
            default => '',
        };
    }
}

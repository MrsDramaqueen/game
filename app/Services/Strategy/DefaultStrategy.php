<?php

namespace App\Services\Strategy;

use App\Entity\Characters;

class DefaultStrategy implements Strategy
{
    public function doStrategyActions(): int|array|string
    {
        return array_rand(Characters::MOVE_COMMAND);
    }
}

<?php

namespace App\Services\Strategy;

use App\Entity\Characters;

class DefaultStrategy implements Strategy
{

    public function doDamage($data)
    {
        // TODO: Implement doDamage() method.
    }

    public function doHill($data)
    {
        // TODO: Implement doHill() method.
    }

    public function doStrategyActions()
    {
        return array_rand(Characters::MOVE_COMMAND);
    }
}

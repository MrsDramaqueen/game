<?php

namespace App\Services\Strategy;

use App\Models\Monster;

class LowHPStrategy implements Strategy
{
    public function doStrategyActions(): string
    {
        return Monster::HILL_COMMAND;
    }
}

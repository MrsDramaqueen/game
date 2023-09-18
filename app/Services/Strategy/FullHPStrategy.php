<?php

namespace App\Services\Strategy;


use App\Models\Monster;

class FullHPStrategy implements Strategy
{
    public function doStrategyActions(): string
    {
        return Monster::HIT_COMMAND;
    }
}

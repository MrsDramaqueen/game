<?php

namespace App\Services\Strategy;

class LowHPStrategy implements Strategy
{
    public function doStrategyActions(): string
    {
        return \App\Models\Monster::HILL_COMMAND;
    }
}

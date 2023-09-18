<?php

namespace App\Services\Strategy;


class FullHPStrategy implements Strategy
{
    public function doStrategyActions(): string
    {
        return \App\Models\Monster::HIT_COMMAND;
    }
}

<?php

namespace App\Services\Strategy;

use App\Entity\Monster\Monster;

class LowHPStrategy implements Strategy
{

    public function doDamage($data)
    {
        return $data * 0.7;
    }

    public function doHill($data)
    {
        return $data * 1.3;
    }

    public function doStrategyActions(): string
    {
        return \App\Models\Monster::HILL_COMMAND;
    }
}

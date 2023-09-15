<?php

namespace App\Services\Strategy;

use App\Entity\Monster\Monster;

class FullHPStrategy implements Strategy
{
    public function doDamage($data)
    {
        return $data * 2;
    }

    public function doHill($data)
    {
        return $data * 0.7;
    }

    public function doStrategyActions()
    {
        return \App\Models\Monster::HIT_COMMAND;
    }
}

<?php

namespace App\Services\Strategy;

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
        // TODO: Implement doStrategyActions() method.
    }
}

<?php

namespace App\Services\Strategy;

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
}

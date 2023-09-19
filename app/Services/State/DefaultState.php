<?php

namespace App\Services\State;

class DefaultState extends State
{

    public function impact(int $damage): int
    {
        return $damage;
    }

    public function health(int $hp): int
    {
        return $hp;
    }
}

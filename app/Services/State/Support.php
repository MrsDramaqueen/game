<?php

namespace App\Services\State;

class Support extends State
{

    public function impact(int $damage): float
    {
        $newDamage = $damage * 0.5;
        $this->characters->goNextState(new DefaultState());
        return $newDamage;
    }

    public function health(int $hp): float|int
    {
        $newHp = $hp * 2;
        $this->characters->goNextState(new DefaultState());
        return $newHp;
    }
}

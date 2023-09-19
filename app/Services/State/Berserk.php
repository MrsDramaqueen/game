<?php

namespace App\Services\State;

class Berserk extends State
{

    public function impact(int $damage): float|int
    {
        $newDamage = $damage * 3;
        $this->characters->goNextState(new DefaultState());
        return $newDamage;
    }

    public function health(int $hp): float|int
    {
        $newHp = $hp * 10;
        $this->characters->goNextState(new DefaultState());
        return $newHp;
    }
}

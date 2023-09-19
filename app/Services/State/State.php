<?php

namespace App\Services\State;

use App\Entity\Characters;

abstract class State
{
    protected Characters $characters;

    /**
     * @param Characters $characters
     */
    public function setCharacter(Characters $characters): void
    {
        $this->characters = $characters;
    }

    abstract public function impact(int $damage);

    abstract public function health(int $hp);
}

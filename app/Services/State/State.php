<?php

namespace App\Services\State;

abstract class State
{
    protected $player;

    /**
     * @param $player
     */
    public function __construct($player)
    {
        $this->player = $player;
    }

    abstract public function impact(int $damage);

    abstract public function health(int $hp);
}

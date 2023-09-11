<?php

namespace App\Services\Player\Commands;

use App\Entity\Player\Player;

class Left implements Command
{
    private $player;

    /**
     * @param Player $player
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function execute()
    {
        $this->player->left();
    }
}

<?php

namespace App\Services\Player\Commands;

use App\Entity\Player\Player;

class Down implements Command
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
        $this->player->down();
    }
}

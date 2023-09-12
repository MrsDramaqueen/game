<?php

namespace App\Services\Player\Commands\BattleCommands;

use App\Entity\Player\Player;
use App\Services\Player\Commands\Command;

class Hill implements Command
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
        $this->player->hill();
    }
}

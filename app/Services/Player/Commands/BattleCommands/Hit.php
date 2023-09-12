<?php

namespace App\Services\Player\Commands\BattleCommands;

use App\Entity\Player\Player;
use App\Services\Player\Commands\Command;

class Hit implements Command
{
    private $player;

    /**
     * @param Player $player
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function execute(): int
    {
        return $this->player->hit();
    }
}

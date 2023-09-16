<?php

namespace App\Services\Player\Commands\BattleCommands;

use App\Entity\Characters;
use App\Services\Player\Commands\Command;

class Hill implements Command
{
    private Characters $characters;

    /**
     * @param Characters $characters
     */
    public function __construct(Characters $characters)
    {
        $this->characters = $characters;
    }

    public function execute()
    {
        $this->characters->hill();
    }
}

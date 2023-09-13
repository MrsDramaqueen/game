<?php

namespace App\Services\Player\Commands;

use App\Entity\Characters;
use App\Entity\Player\Player;

class Right implements Command
{
    private $characters;

    /**
     * @param Player $player
     */
    public function __construct(Characters $characters)
    {
        $this->characters = $characters;
    }

    public function execute()
    {
        $this->characters->right();
    }
}

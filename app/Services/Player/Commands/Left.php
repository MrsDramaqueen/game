<?php

namespace App\Services\Player\Commands;

use App\Entity\Characters;
use App\Entity\Player\Player;

class Left implements Command
{
    private $characters;

    /**
     * @param Characters $characters
     */
    public function __construct(Characters $characters)
    {
        $this->characters = $characters;
    }

    public function execute()
    {
        $this->characters->left();
    }
}

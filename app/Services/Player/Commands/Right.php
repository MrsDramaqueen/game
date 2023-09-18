<?php

namespace App\Services\Player\Commands;

use App\Entity\Characters;

class Right implements Command
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
        $this->characters->right();
    }
}

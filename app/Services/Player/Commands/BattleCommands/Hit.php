<?php

namespace App\Services\Player\Commands\BattleCommands;

use App\Entity\Characters;
use App\Entity\Player\Player;
use App\Services\Player\Commands\Command;

class Hit implements Command
{
    private $characters;

    private $enemyCharacters;

    /**
     * @param Characters $characters
     * @param $enemyCharacters
     */
    public function __construct(Characters $characters, $enemyCharacters)
    {
        $this->characters = $characters;
        $this->enemyCharacters = $enemyCharacters;
    }

    public function execute()
    {
        $playerDamage = $this->characters->hit();
        $this->enemyCharacters->setHP(max($this->enemyCharacters->getHP() - $playerDamage, 0));

        //TODO: Либо перенести в другое место, либо вообще убрать.
        if($this->enemyCharacters->getHP() == 0) {
            $this->enemyCharacters->setDamage(0);
        }
    }
}

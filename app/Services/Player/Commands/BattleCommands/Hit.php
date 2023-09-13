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
     * @param $monster
     */
    public function __construct(Characters $characters, $enemyCharacters)
    {
        $this->characters = $characters;
        $this->enemyCharacters = $enemyCharacters;
    }

    public function execute()
    {
        $playerDamage = $this->characters->hit();
        //dd(max($this->enemyCharacters->getHP() - $playerDamage, 0));
        $this->enemyCharacters->setHP(max($this->enemyCharacters->getHP() - $playerDamage, 0));

        if($this->enemyCharacters->getHP() == 0) {
            $this->enemyCharacters->setDamage(0);
        }

        //TODO: вынести для противников отдельно?
       /* $monsterDamage = $this->enemyCharacters->hit();
        $this->characters->setHp(max($this->characters->getHP() - $monsterDamage, 0));*/
    }
}

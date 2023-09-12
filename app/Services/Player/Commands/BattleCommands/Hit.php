<?php

namespace App\Services\Player\Commands\BattleCommands;

use App\Entity\Player\Player;
use App\Services\Player\Commands\Command;

class Hit implements Command
{
    private $player;

    private $monster;

    /**
     * @param Player $player
     */
    public function __construct(Player $player, $monster)
    {
        $this->player = $player;
        $this->monster = $monster;
    }

    public function execute()
    {
        $playerDamage = $this->player->hit();
        $this->monster->setHP(max($this->monster->getHP() - $playerDamage, 0));

        //TODO: вынести для противников отдельно?
        $monsterDamage = $this->monster->hit();
        $this->player->setHp(max($this->player->getHP() - $monsterDamage, 0));
    }
}

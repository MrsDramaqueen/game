<?php

namespace App\Services\Mediator;

use App\Entity\Characters;
use App\Entity\Monster\ListMonsters;
use App\Models\Player;

class ActionMediator implements Mediator
{
    private $monsters;

    /**
     * @param ListMonsters $monsters
     */
    public function __construct(ListMonsters $monsters)
    {
        $this->monsters = $monsters;
        $this->monsters->setMediator($this);
    }

    public function notify(object $sender, string $event, array $datas): string
    {
        if ($sender->getHp() < 25 || $this->nearPlayer($sender)) {
            $action = Characters::BATTLE_TYPE_COMMAND;
        } else {
            $action = Characters::MOVE_TYPE_COMMAND;
        }

        return $action;
    }

    private function nearPlayer($monster): bool
    {
        $near = false;
        $player = Player::query()->get()->first();

        //TODO: Подумать над логикой выбора противника, если под условие подойдет больше 1-го + переработать условие
        if (abs($monster->getPositionHeight() - $player->getPositionHeight()) == 1
            && abs($monster->getPositionWidth() == $player->getPositionWidth())
            || (abs($monster->getPositionWidth() - $player->getPositionWidth()) == 1)
            && abs($monster->getPositionHeight() == $player->getPositionHeight())) {
            $near = true;
        }

        return $near;
    }
}

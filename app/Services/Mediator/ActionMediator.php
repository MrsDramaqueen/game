<?php

namespace App\Services\Mediator;

use App\Entity\Characters;
use App\Entity\Monster\ListMonsters;
use App\Models\Player;

class ActionMediator implements Mediator
{
    private ListMonsters $monsters;

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
        if ($sender->getHp() < Characters::MIN_HP_FOR_HILL || $this->nearPlayer($sender)) {
            $action = Characters::BATTLE_TYPE_COMMAND;
        } else {
            $action = Characters::MOVE_TYPE_COMMAND;
        }

        return $action;
    }

    private function nearPlayer(object $monster): bool
    {
        $near = false;
        $player = Player::query()->get()->first();

        //TODO: Подумать над логикой выбора противника, если под условие подойдет больше 1-го + переработать условие
        if (abs($monster->getPositionHeight() - $player->getPositionHeight()) == Characters::MIN_DIFF_CELL_FOR_DAMAGE
            && abs($monster->getPositionWidth() == $player->getPositionWidth())
            || (abs($monster->getPositionWidth() - $player->getPositionWidth()) == Characters::MIN_DIFF_CELL_FOR_DAMAGE)
            && abs($monster->getPositionHeight() == $player->getPositionHeight())) {
            $near = true;
        }

        return $near;
    }
}

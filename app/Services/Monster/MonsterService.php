<?php

namespace App\Services\Monster;

use App\Entity\Monster\ListMonsters;
use App\Entity\Monster\Monster;
use App\Entity\Player\Player;
use App\Services\Mediator\ActionMediator;
use App\Services\Mediator\StrategyMediator\StrategyMediator;
use App\Services\Player\BattleService;
use App\Services\Player\MoveService;

class MonsterService
{
    public static function setMonster(\App\Models\Monster $monster): Monster
    {
        $positionWidth = rand(3, 8);
        $positionHeight = rand(3, 8);

        return (new Monster())
            ->setId($monster->getId())
            ->setHp($monster->getHp())
            ->setDamage($monster->getDamage())
            ->setType($monster->getType())
            ->setPositionWidth($monster->getPositionWidth())
            ->setPositionHeight($monster->getPositionHeight())
            ->setMana($monster->getMana());
    }

    public function action(): void
    {
        $strategyMediator = new StrategyMediator(ListMonsters::getInstance());
        $actionMediator = new ActionMediator(ListMonsters::getInstance());
        $monsters = ListMonsters::getInstance()->getMonsters();

        foreach ($monsters as $monster) {
            $action = ListMonsters::getInstance()->getAction($actionMediator, $monster);
            $monsterCommand = ListMonsters::getInstance()->doAction($strategyMediator, $monster, $action);
            $this->{$action}($monsterCommand, $monster);
        }
    }

    protected function move($command, $monster): void
    {
        $command = MoveService::getMoveCommand($command, $monster);
        $command->execute();
    }

    protected function battle($command, $monster): void
    {
        $command = BattleService::getBattleCommand($command, $monster, Player::getInstance());
        $command->execute();
    }
}

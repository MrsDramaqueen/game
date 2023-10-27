<?php

namespace App\Services\Monster;

use App\Entity\Monster\ListMonsters;
use App\Models\BoardPosition;
use \App\Models\Monster;
use App\Entity\Monster\Monster as MonsterCharacter;
use App\Entity\Player\Player;
use App\Services\Game\LogService;
use App\Services\Mediator\ActionMediator;
use App\Services\Mediator\StrategyMediator\StrategyMediator;
use App\Services\Player\BattleService;
use App\Services\Player\MoveService;

class MonsterService
{
    public static function setMonster(Monster $monster): MonsterCharacter
    {
        $monsterBoardPositions = (new \App\Entity\Board\BoardPosition())
            ->setEntityId($monster->getId())
            ->setEntityType(ENTITY_TYPE_MONSTERS)
            ->setHeightPosition($monster->getPositionHeight())
            ->setWidthPosition($monster->getPositionWidth());

        //$monsterBoardPositions->save();

        return (new MonsterCharacter())
            ->setId($monster->getId())
            ->setHp($monster->getHp())
            ->setDamage($monster->getDamage())
            ->setType($monster->getType())
            ->setPositionWidth($monsterBoardPositions->getHeightPosition())
            ->setPositionHeight($monsterBoardPositions->getWidthPosition())
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

    protected function move(string $command, MonsterCharacter $monster): void
    {
        LogService::log('Монстр ' . $monster->getId() . " сходил $command");
        $command = MoveService::getMoveCommand($command, $monster);
        $command->execute();
    }

    protected function battle(string $command, MonsterCharacter $monster): void
    {
        LogService::log('Монстр ' . $monster->getId() . " использовал $command");
        $command = BattleService::getBattleCommand($command, $monster, Player::getInstance());
        $command->execute();
    }
}

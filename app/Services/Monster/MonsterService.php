<?php

namespace App\Services\Monster;

use App\Entity\Monster\ListMonsters;
use App\Entity\Monster\Monster;
use App\Entity\Player\Player;
use App\Services\Mediator\StrategyMediator\StrategyMediator;
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

    public function action($action, $command)
    {
        $strategyMediator = new StrategyMediator(ListMonsters::getInstance());

        $monsters = ListMonsters::getInstance()->getMonsters();


            //Пока что имитация выборы команды для того, чтобы противники вели себя по-разному

            $this->{$action}($command);

    }

    protected function move($command)
    {
        $monsters = ListMonsters::getInstance()->getMonsters();
        foreach ($monsters as $monster) {
            $command = MoveService::getMoveCommand($command, $monster);
            $command->execute();
        }

    }

    protected function battle()
    {

    }
}

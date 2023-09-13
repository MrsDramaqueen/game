<?php

namespace App\Services\Monster;

use App\Entity\Monster\ListMonsters;
use App\Entity\Monster\Monster;
use App\Entity\Player\Player;
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

    public function action($action, $playerCommand)
    {
        $strategyMediator = new StrategyMediator(ListMonsters::getInstance());


        $monsters = ListMonsters::getInstance()->getMonsters();

        //Пока что имитация выборы команды для того, чтобы противники вели себя по-разному
        //Тут будет вызываться посредник, который будет выбирать стратегию
        foreach ($monsters as $monster) {
            $monsterCommand = ListMonsters::getInstance()->doAction($strategyMediator, $monster);
            $this->{$action}($monsterCommand, $monster);
        }
    }

    protected function move($command, $monster)
    {
        //$monsters = ListMonsters::getInstance()->getMonsters();

        $command = MoveService::getMoveCommand($command, $monster);
        $command->execute();


    }

    protected function battle($command, $monster)
    {
        $command = BattleService::getBattleCommand($command, $monster, Player::getInstance());
        $command->execute();
    }
}

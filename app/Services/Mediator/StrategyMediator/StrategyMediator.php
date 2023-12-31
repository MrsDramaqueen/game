<?php

namespace App\Services\Mediator\StrategyMediator;

use App\Entity\Characters;
use App\Entity\Monster\ListMonsters;
use App\Services\Mediator\Mediator;
use App\Services\State\Berserk;
use App\Services\Strategy\DefaultStrategy;
use App\Services\Strategy\FullHPStrategy;
use App\Services\Strategy\LowHPStrategy;

class StrategyMediator implements Mediator
{
    private array|ListMonsters $monsters;

    /**
     * @param array $monsters
     */
    public function __construct(ListMonsters $monsters)
    {
        $this->monsters = $monsters;
        $this->monsters->setMediator($this);
    }

    public function notify(object $sender, string $event, array $datas)
    {
        /** @var $sender \App\Entity\Monster\Monster */

        //TODO: Убрать этот костыль, наверно развести команды удара и хилла
        if ($event == Characters::BATTLE_TYPE_COMMAND && $sender->getHp() < 25) {
            $sender->goNextState(new Berserk());
            //$sender->getNewDamage();
            $sender->getNewHp();
            //будет когда уберется костыль
            //$event = array_rand([Characters::HILL_COMMAND, array_rand(Characters::MOVE_COMMAND)]);
            $event = Characters::HILL_COMMAND;
        }

        $className = match ($event) {
            Characters::BATTLE_TYPE_COMMAND => FullHPStrategy::class,
            Characters::HILL_COMMAND => LowHPStrategy::class,
            default => DefaultStrategy::class,
        };
        $sender->setStrategy(new $className());
        return $sender->doAction();
    }
}

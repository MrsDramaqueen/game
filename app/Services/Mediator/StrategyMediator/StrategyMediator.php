<?php

namespace App\Services\Mediator\StrategyMediator;

use App\Entity\Monster\ListMonsters;
use App\Models\Monster;
use App\Services\Mediator\Mediator;
use App\Services\Strategy\DefaultStrategy;
use App\Services\Strategy\FullHPStrategy;
use App\Services\Strategy\LowHPStrategy;

class StrategyMediator implements Mediator
{
    private $monsters;

    /**
     * @param array $monsters
     */
    public function __construct(ListMonsters $monsters)
    {
        $this->monsters = $monsters;
        $this->monsters->setMediator($this);
    }


    //TODO: Убрать перебор монстров в каждом методе, а то херня какая-то получается
    public function notify(object $sender, string $event, array $datas)
    {
        /** @var $data \App\Entity\Monster\Monster */

        foreach ($datas as $data) {
            $className = match ($event) {
                Monster::BERSERK_STATE => FullHPStrategy::class,
                Monster::HILLER_STATE => LowHPStrategy::class,
                default => DefaultStrategy::class,
            };
            $data->setStrategy(new $className());
            return $data->doAction();
        }
    }
}

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


    public function notify(object $sender, string $event, array $datas)
    {
        /** @var $data \App\Entity\Monster\Monster */

        foreach ($datas as $data) {
            match ($event) {
                Monster::BERSERK_STATE => $className = 'App\Services\Strategy\FullHPStrategy'/*$data->setStrategy(new FullHPStrategy())*/,
                Monster::HILLER_STATE => $className = 'App\Services\Strategy\LowHPStrategy',
                default => $className = 'App\Services\Strategy\DefaultStrategy'/*$data->setStrategy(new DefaultStrategy())*/
            };
            $data->setStrategy(new $className());
            return $data->doAction();
        }
    }
}

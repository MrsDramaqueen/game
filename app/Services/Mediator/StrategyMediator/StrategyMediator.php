<?php

namespace App\Services\Mediator\StrategyMediator;

use App\Entity\Monster\ListMonsters;
use App\Models\Monster;
use App\Services\Mediator\Mediator;
use App\Services\Strategy\FullHPStrategy;

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
            if ($event == Monster::BERSERK_STATE) {
                $data->setStrategy(new FullHPStrategy());
                $data->doAction();
                //TODO: в блоках if должна выбираться стратегия
            }
        }

    }
}

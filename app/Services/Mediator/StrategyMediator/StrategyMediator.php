<?php

namespace App\Services\Mediator\StrategyMediator;

use App\Entity\Monster\ListMonsters;
use App\Services\Mediator\Mediator;

class StrategyMediator implements Mediator
{
    private ListMonsters $monsters;

    /**
     * @param array $monsters
     */
    public function __construct(ListMonsters $monsters)
    {
        $this->monsters = $monsters;
        $this->monsters->setMediator($this);
    }


    public function notify(object $sender, string $command, array $datas)
    {
        // TODO: Implement notify() method.
    }
}

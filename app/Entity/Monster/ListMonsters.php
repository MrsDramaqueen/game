<?php

namespace App\Entity\Monster;

use App\Entity\Characters;
use App\Entity\Obstacle\ListObstacles;
use App\Services\Mediator\Mediator;
use App\Services\Mediator\MoveMediator;
use App\Traits\Singleton;

class ListMonsters
{
    use Singleton;

    protected array $monsters;

    protected $mediator;

    /**
     * @param Mediator|null $mediator
     */
    public function __construct(Mediator $mediator = null)
    {
        $this->mediator = $mediator;
    }

    /**
     * @param mixed|null $mediator
     * @return ListMonsters
     */
    public function setMediator(Mediator $mediator): ListMonsters
    {
        $this->mediator = $mediator;
        return $this;
    }

    /**
     * @return array
     */
    public function getMonsters(): array
    {
        return $this->monsters;
    }

    /**
     * @param array $monsters
     * @return ListMonsters
     */
    public function setMonsters(array $monsters): ListMonsters
    {
        $this->monsters = $monsters;
        return $this;
    }

    public function getAction($actionMediator, $monster)
    {
        $state = '';
        $this->setMediator($actionMediator);
        return $this->mediator->notify($monster, $state, $this->getMonsters());
    }

    public function doAction($strategyMediator, $monster, $action): string
    {
        $state = '';
        $listMonsters = $this->getMonsters();

        //TODO: Добавить state для монстра
        //$state = $monster->getState();
        $this->setMediator($strategyMediator);
        $monsterCommand = $this->mediator->notify($monster, $action, $listMonsters);

        if (in_array($monsterCommand, Characters::MOVE_COMMAND)){
            $moveMediator = new MoveMediator($monster);
            $monsterCommand = ListObstacles::getInstance()->getCommand($moveMediator, $monsterCommand);
        }

        return $monsterCommand;
    }
}

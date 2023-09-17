<?php

namespace App\Entity\Monster;

use App\Entity\Characters;
use App\Entity\Obstacle\ListObstacles;
use App\Services\Mediator\Mediator;
use App\Services\Mediator\MoveMediator;
use App\Traits\Singleton;

class ListMonsters implements Characters
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

    public function hit()
    {
        foreach ($this->getMonsters() as $monster) {
            $monster->hit();
        }

    }

    public function up()
    {
        foreach ($this->getMonsters() as $monster) {
            $monster->up();
        }

    }

    public function down()
    {
        foreach ($this->getMonsters() as $monster) {
           $monster->down();
        }

    }

    public function left(): void
    {
        foreach ($this->getMonsters() as $monster) {
            $monster->left();
        }
    }

    public function right()
    {
        foreach ($this->getMonsters() as $monster) {
            $monster->right();
        }
    }

    public function hill()
    {
        // TODO: Implement hill() method.
    }

    //TODO: От состояния в посреднике будет выбираться стратегия, в которой будут выполняться команды
    public function doAction($strategyMediator, $monster): string
    {
        $state = '';
        $listMonsters = $this->getMonsters();

        //TODO: Добавить state для монстра
        //$state = $monster->getState();
        $this->setMediator($strategyMediator);
        $monsterCommand = $this->mediator->notify($monster, $state, $listMonsters);

        if (in_array($monsterCommand, Characters::MOVE_COMMAND)){
            //$monsterCommand = 'down';
            $moveMediator = new MoveMediator($monster);
            $monsterCommand = ListObstacles::getInstance()->getPositions($moveMediator, $monsterCommand);
        }

        return $monsterCommand;
    }
}

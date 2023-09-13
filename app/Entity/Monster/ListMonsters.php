<?php

namespace App\Entity\Monster;

use App\Entity\Characters;
use App\Services\Mediator\Mediator;
use App\Traits\Singleton;

class ListMonsters implements Characters
{
    use Singleton;

    protected array $monsters;

    protected $mediator;

    /**
     * @param $mediator
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
}

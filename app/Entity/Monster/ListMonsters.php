<?php

namespace App\Entity\Monster;

use App\Services\Mediator\Mediator;
use App\Traits\Singleton;

class ListMonsters
{
    use Singleton;

    protected array $monsters;

    protected $mediator;

    /**
     * @param $mediator
     */
    public function __construct($mediator = null)
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
}

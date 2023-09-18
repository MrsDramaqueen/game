<?php

namespace App\Entity\Obstacle;

use App\Services\Mediator\Mediator;
use App\Traits\Singleton;

class ListObstacles
{
    use Singleton;

    protected array $obstacles;

    protected ?Mediator $mediator;

    public function __construct(Mediator $mediator = null)
    {
        $this->mediator = $mediator;
    }

    public function setMediator(Mediator $mediator): void
    {
        $this->mediator = $mediator;
    }
    /**
     * @return array
     */
    public function getObstacles(): array
    {
        return $this->obstacles;
    }

    /**
     * @param array $obstacles
     * @return ListObstacles
     */
    public function setObstacles(array $obstacles): ListObstacles
    {
        $this->obstacles = $obstacles;
        return $this;
    }

    public function getCommand($moveMediator, $command)
    {
        $listObstacles = $this->getObstacles();
        $boardPositions = [];
        foreach ($listObstacles as $obstacle) {
            $boardPositions[] = [
                'height' => $obstacle->getPositionHeight(),
                'width' => $obstacle->getPositionWidth(),
            ];
        }

        $this->setMediator($moveMediator);

        return $this->mediator->notify($this, $command, $boardPositions);
    }

    private function getObstaclePositions()
    {

    }
}

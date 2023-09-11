<?php

namespace App\Entity\Obstacle;


use App\Services\Mediator\Mediator;

class Obstacle
{
    protected string $type;

    protected int $positionWidth;

    protected int $positionHeight;

    protected $mediator;

    public function __construct(Mediator $mediator = null)
    {
        $this->mediator = $mediator;
    }

    public function setMediator(Mediator $mediator): void
    {
        $this->mediator = $mediator;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Obstacle
     */
    public function setType(string $type): Obstacle
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getPositionWidth(): int
    {
        return $this->positionWidth;
    }

    /**
     * @param int $positionWidth
     * @return Obstacle
     */
    public function setPositionWidth(int $positionWidth): Obstacle
    {
        $this->positionWidth = $positionWidth;
        return $this;
    }

    /**
     * @return int
     */
    public function getPositionHeight(): int
    {
        return $this->positionHeight;
    }

    /**
     * @param int $positionHeight
     * @return Obstacle
     */
    public function setPositionHeight(int $positionHeight): Obstacle
    {
        $this->positionHeight = $positionHeight;
        return $this;
    }

   /* public function getPositions(): void
    {
        $boardPositions = [
            'height' => $this->getPositionHeight(),
            'width' => $this->getPositionWidth(),
        ];

        $this->mediator->notify($this, $boardPositions);
    }*/
}

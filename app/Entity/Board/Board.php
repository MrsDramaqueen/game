<?php

namespace App\Entity\Board;

use App\Traits\Singleton;

class Board
{
    use Singleton;

    protected int $width;

    protected int $height;

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return Board
     */
    public function setWidth(int $width): Board
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return Board
     */
    public function setHeight(int $height): Board
    {
        $this->height = $height;
        return $this;
    }
}

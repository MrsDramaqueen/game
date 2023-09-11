<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $weight
 * @property int $height
 */
class Board extends Model
{
    use HasFactory;

    const HEIGHT = 8;

    const WIDTH = 8;

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     * @return Board
     */
    public function setWeight(int $weight): Board
    {
        $this->weight = $weight;
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

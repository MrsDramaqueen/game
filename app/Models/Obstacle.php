<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property int $position_width
 * @property int $position_height
 */
class Obstacle extends Model
{
    use HasFactory;

    const STONE_TYPE = 'stone';

    const FIRE_TYPE = 'fire';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Obstacle
     */
    public function setId(int $id): Obstacle
    {
        $this->id = $id;
        return $this;
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
        return $this->position_width;
    }

    /**
     * @param int $position_width
     * @return Obstacle
     */
    public function setPositionWidth(int $position_width): Obstacle
    {
        $this->position_width = $position_width;
        return $this;
    }

    /**
     * @return int
     */
    public function getPositionHeight(): int
    {
        return $this->position_height;
    }

    /**
     * @param int $position_height
     * @return Obstacle
     */
    public function setPositionHeight(int $position_height): Obstacle
    {
        $this->position_height = $position_height;
        return $this;
    }
}

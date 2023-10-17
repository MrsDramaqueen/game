<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Board
 *
 * @property int $weight
 * @property int $height
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Board newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Board newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Board query()
 * @method static \Illuminate\Database\Eloquent\Builder|Board whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Board whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Board whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Board whereWeight($value)
 * @mixin \Eloquent
 */
class Board extends Model
{
    use HasFactory;
    const MINIMUM_COORDINATE = 1;
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

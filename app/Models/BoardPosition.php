<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\BoardPosition
 *
 * @property int $id
 * @property int $height_position
 * @property int $width_position
 * @property int $entity_id
 * @property string $entity_type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|BoardPosition newModelQuery()
 * @method static Builder|BoardPosition newQuery()
 * @method static Builder|BoardPosition query()
 * @method static Builder|BoardPosition whereCreatedAt($value)
 * @method static Builder|BoardPosition whereEntityId($value)
 * @method static Builder|BoardPosition whereEntityType($value)
 * @method static Builder|BoardPosition whereHeightPosition($value)
 * @method static Builder|BoardPosition whereId($value)
 * @method static Builder|BoardPosition whereUpdatedAt($value)
 * @method static Builder|BoardPosition whereWidthPosition($value)
 * @mixin \Eloquent
 */
class BoardPosition extends Model
{
    use HasFactory;

    public function boardPositionable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return BoardPosition
     */
    public function setId(int $id): BoardPosition
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeightPosition(): int
    {
        return $this->height_position;
    }

    /**
     * @param int $height_position
     * @return BoardPosition
     */
    public function setHeightPosition(int $height_position): BoardPosition
    {
        $this->height_position = $height_position;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidthPosition(): int
    {
        return $this->width_position;
    }

    /**
     * @param int $width_position
     * @return BoardPosition
     */
    public function setWidthPosition(int $width_position): BoardPosition
    {
        $this->width_position = $width_position;
        return $this;
    }

    /**
     * @return int
     */
    public function getEntityId(): int
    {
        return $this->entity_id;
    }

    /**
     * @param int $entity_id
     * @return BoardPosition
     */
    public function setEntityId(int $entity_id): BoardPosition
    {
        $this->entity_id = $entity_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEntityType(): string
    {
        return $this->entity_type;
    }

    /**
     * @param string $entity_type
     * @return BoardPosition
     */
    public function setEntityType(string $entity_type): BoardPosition
    {
        $this->entity_type = $entity_type;
        return $this;
    }

    /**
     * @return Carbon|null
     */
    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at;
    }

    /**
     * @return Carbon|null
     */
    public function getUpdatedAt(): ?Carbon
    {
        return $this->updated_at;
    }
}

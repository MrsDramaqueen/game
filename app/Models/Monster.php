<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * App\Models\Monster
 *
 * @property int $id
 * @property string $type
 * @property int $hp
 * @property int $damage
 * @property int $position_width
 * @property int $position_height
 * @property int $mana
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Monster newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Monster newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Monster query()
 * @method static \Illuminate\Database\Eloquent\Builder|Monster whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster whereDamage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster whereHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster whereMana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster wherePositionHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster wherePositionWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monster whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Monster extends Model
{
    use HasFactory;

    protected $fillable = ['hp', 'damage', 'position_width', 'position_height'];

    const GOBLIN_TYPE = 'goblin';

    const CIRCLE_WITH_SWORD_TYPE = 'circle';

    const MONSTER_TYPE = [
        self::GOBLIN_TYPE => 'goblin',
        self::CIRCLE_WITH_SWORD_TYPE => 'circle',
    ];

    const HILL_COMMAND = 'hill';

    const HIT_COMMAND = 'hit';

    const BERSERK_STATE = 'berserk';

    const HILLER_STATE = 'hiller';
    const MONSTER_HP = 100;
    const MONSTER_DAMAGE = 20;
    const MONSTER_MANA = 50;

    public function boardPosition(): MorphOne
    {
        return $this->morphOne(BoardPosition::class, 'board_positionable');
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
     * @return Monster
     */
    public function setId(int $id): Monster
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
     * @return Monster
     */
    public function setType(string $type): Monster
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getMana(): int
    {
        return $this->mana;
    }

    /**
     * @param int $mana
     * @return Monster
     */
    public function setMana(int $mana): Monster
    {
        $this->mana = $mana;
        return $this;
    }

    /**
     * @return int
     */
    public function getHp(): int
    {
        return $this->hp;
    }

    /**
     * @param int $hp
     * @return Monster
     */
    public function setHp(int $hp): Monster
    {
        $this->hp = $hp;
        return $this;
    }

    /**
     * @return int
     */
    public function getDamage(): int
    {
        return $this->damage;
    }

    /**
     * @param int $damage
     * @return Monster
     */
    public function setDamage(int $damage): Monster
    {
        $this->damage = $damage;
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
     * @return Monster
     */
    public function setPositionWidth(int $position_width): Monster
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
     * @return Monster
     */
    public function setPositionHeight(int $position_height): Monster
    {
        $this->position_height = $position_height;
        return $this;
    }
}

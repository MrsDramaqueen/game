<?php

namespace App\Entity\Player;

use App\Services\Mediator\Mediator;
use App\Traits\Singleton;

class Player
{
    use Singleton;

    protected int $hp;

    protected int $level;

    protected int $exp;

    protected int $damage;

    protected string $state;

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
     * @return int
     */
    public function getHp(): int
    {
        return $this->hp;
    }

    /**
     * @param int $hp
     * @return Player
     */
    public function setHp(int $hp): Player
    {
        $this->hp = $hp;
        return $this;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     * @return Player
     */
    public function setLevel(int $level): Player
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return int
     */
    public function getExp(): int
    {
        return $this->exp;
    }

    /**
     * @param int $exp
     * @return Player
     */
    public function setExp(int $exp): Player
    {
        $this->exp = $exp;
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
     * @return Player
     */
    public function setDamage(int $damage): Player
    {
        $this->damage = $damage;
        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return Player
     */
    public function setState(string $state): Player
    {
        $this->state = $state;
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
     * @return Player
     */
    public function setPositionWidth(int $positionWidth): Player
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
     * @return Player
     */
    public function setPositionHeight(int $positionHeight): Player
    {
        $this->positionHeight = $positionHeight;
        return $this;
    }

    /**
     * @return void
     */
    public function up(): void
    {
        $this->setPositionHeight($this->getPositionHeight() - 1);
    }

    /**
     * @return void
     */
    public function down(): void
    {
        $this->setPositionHeight($this->getPositionHeight() + 1);
    }

    /**
     * @return void
     */
    public function left(): void
    {
        $this->setPositionWidth($this->getPositionWidth() - 1);
    }

    /**
     * @return void
     */
    public function right(): void
    {
        $this->setPositionWidth($this->getPositionWidth() + 1);
    }
}

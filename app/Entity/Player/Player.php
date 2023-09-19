<?php

namespace App\Entity\Player;

use App\Entity\Characters;
use App\Services\Game\LogService;
use App\Services\Mediator\Mediator;
use App\Services\Strategy\Strategy;
use App\Traits\Singleton;

class Player implements Characters
{
    use Singleton;

    protected int $hp;

    protected int $level;

    protected int $exp;

    protected int $damage;

    protected string $state;

    protected int $positionWidth;

    protected int $positionHeight;

    public int $id;

    protected int $mana;

    protected ?Mediator $mediator;

    protected ?Strategy $strategy;

    public function __construct(Mediator $mediator = null, Strategy $strategy = null)
    {
        $this->mediator = $mediator;
        $this->strategy = $strategy;
    }

    public function setMediator(Mediator $mediator): void
    {
        $this->mediator = $mediator;
    }

    public function setStrategy(Strategy $strategy): void
    {
        $this->strategy = $strategy;
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
     * @return Player
     */
    public function setId(int $id): Player
    {
        $this->id = $id;
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
     * @return Player
     */
    public function setMana(int $mana): Player
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

    public function doActionStrategy()
    {
        $this->strategy->doDamage($this->getDamage());
        //$this->strategy->doHill();
    }

    public function hill()
    {
        //TODO: МБ Сделать даективацию кнопки если нет маны
        if ($this->getHp() < \App\Models\Player::HP && $this->getMana() > 0) {
            $this->setHp(min($this->getHp() + 10, 100));
            $this->setMana($this->getMana() - 10);
        } else {
            LogService::log('Недостаточно маны или вы восполнили здоровье на максимум');
        }
    }

    public function hit()
    {
        return $this->getDamage();
    }

    public function manaRecovery(): void
    {
        if ($this->getMana() < \App\Models\Player::MAX_MANA) {
            $this->setMana($this->getMana() + 5);
            LogService::log('Восстановление маны');
        }
    }

    public function stay()
    {
        // TODO: Implement stay() method.
    }
}

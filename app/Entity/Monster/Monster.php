<?php

namespace App\Entity\Monster;

use App\Entity\Characters;

class Monster implements Characters
{
    protected int $hp;

    protected int $damage;

    protected string $type;

    protected int $positionWidth;

    protected int $positionHeight;

    protected int $mana;

    public int $id;

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
    public function getPositionWidth(): int
    {
        return $this->positionWidth;
    }

    /**
     * @param int $positionWidth
     * @return Monster
     */
    public function setPositionWidth(int $positionWidth): Monster
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
     * @return Monster
     */
    public function setPositionHeight(int $positionHeight): Monster
    {
        $this->positionHeight = $positionHeight;
        return $this;
    }

    public function hit()
    {
        return $this->getDamage();
    }

    public function up()
    {
        $this->setPositionHeight($this->getPositionHeight() - 1);
    }

    public function down()
    {
        $this->setPositionHeight($this->getPositionHeight() + 1);
    }

    public function left()
    {
        $this->setPositionWidth($this->getPositionWidth() - 1);
    }

    public function right()
    {
        $this->setPositionWidth($this->getPositionWidth() + 1);
    }

    public function hill()
    {
        // TODO: Implement hill() method.
    }
}

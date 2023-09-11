<?php

namespace App\Entity\Monster;

use App\Traits\Singleton;

class ListMonsters
{
    use Singleton;

    protected array $monsters;

    /**
     * @return array
     */
    public function getMonsters(): array
    {
        return $this->monsters;
    }

    /**
     * @param array $monsters
     * @return ListMonsters
     */
    public function setMonsters(array $monsters): ListMonsters
    {
        $this->monsters = $monsters;
        return $this;
    }
}

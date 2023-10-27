<?php

namespace App\Entity\Game;

class GameEntity
{
    private string $gameMode;

    /**
     * @return string
     */
    public function getGameMode(): string
    {
        return $this->gameMode;
    }

    /**
     * @param string $gameMode
     * @return GameEntity
     */
    public function setGameMode(string $gameMode): GameEntity
    {
        $this->gameMode = $gameMode;
        return $this;
    }
}

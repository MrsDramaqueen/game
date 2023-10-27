<?php

namespace App\Services\Game;

use App\Entity\Game\GameEntity;
use App\Entity\Monster\ListMonsters;
use App\Entity\Obstacle\ListObstacles;
use App\Jobs\Monster\NewMonster;
use App\Models\Board;
use App\Models\Monster;
use App\Models\Obstacle;
use App\Models\Player;
use App\Services\Board\BoardService;
use App\Services\Monster\MonsterService;
use App\Services\Obstacle\ObstacleService;
use App\Services\Player\PlayerService;


class GameService
{
    public function __construct()
    {
        $this->getMode();
        $this->getPlayer();
        $this->getBoard();
        $this->getMonsters();
        $this->getObstacles();
    }

    private function getPlayer(): void
    {
        $player = Player::query()->get()->first();
        PlayerService::setPlayer($player);
    }

    private function getMode(): string
    {
        $requestUri = \request()->getRequestUri();
        $mode = str_contains($requestUri, GAME_MODE_SURVIVE) ? GAME_MODE_SURVIVE : GAME_MODE_NORMAL;
        $gameEntity = (new GameEntity())->setGameMode($mode);

        return $gameEntity->getGameMode();
    }

    private function getBoard(): void
    {
        $board = Board::query()->get()->first();
        BoardService::setBoard($board);

    }

    public function getMonsters(): void
    {
        $monsters = Monster::query()->get()->map(function (Monster $monster) {
            return MonsterService::setMonster($monster);
        })->toArray();

        ListMonsters::getInstance()->setMonsters($monsters);
    }

    private function getObstacles(): void
    {
        $obstacles = Obstacle::query()->get()->map(function (Obstacle $obstacle) {
            return ObstacleService::setObstacle($obstacle);
        })->toArray();

        ListObstacles::getInstance()->setObstacles($obstacles);
    }

    public static function index(): GameService
    {
        return new self();
    }
}

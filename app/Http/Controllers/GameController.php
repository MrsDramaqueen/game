<?php

namespace App\Http\Controllers;

use App\Entity\Board\Board;
use App\Entity\Game\GameEntity;
use App\Entity\Monster\ListMonsters;
use App\Entity\Obstacle\ListObstacles;
use App\Entity\Player\Player;
use App\Http\Requests\MoveRequest;
use App\Jobs\Monster\NewMonster;
use App\Models\Monster;
use App\Services\Game\GameService;
use App\Services\Game\LogService;
use App\Services\Game\NewGame;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function menu(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('game/start');
    }

    public static function start(NewGame $newGame, GameService $gameService): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $requestUri = \request()->getRequestUri();
        $mode = str_contains($requestUri, GAME_MODE_SURVIVE) ? GAME_MODE_SURVIVE : GAME_MODE_NORMAL;
        $gameEntity = (new GameEntity())->setGameMode($mode);
        $gameMode = $gameEntity->getGameMode();
        if ($gameMode == GAME_MODE_SURVIVE) {
            $monster = Monster::query()->first();
            NewMonster::dispatch($monster)->delay(60);
        }
        $player = Player::getInstance();
        $board = Board::getInstance();
        $monsters = ListMonsters::getInstance()->getMonsters();
        $obstacles = ListObstacles::getInstance()->getObstacles();

        LogService::log('Game is started');

        return view('game/index', [
            'player' => $player,
            'board' => $board,
            'monsters' => $monsters,
            'obstacles' => $obstacles,
        ]);
    }

    public static function getViewGameOver(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return \view('gameOver');
    }

    /**
     * @return string
     */
    public static function getViewBoard(): string
    {
        $player = Player::getInstance();
        $board = Board::getInstance();
        $monsters = ListMonsters::getInstance()->getMonsters();
        $obstacles = ListObstacles::getInstance()->getObstacles();

        return view('game/board', [
            'player' => $player,
            'board' => $board,
            'monsters' => $monsters,
            'obstacles' => $obstacles
        ])->render();
    }
}

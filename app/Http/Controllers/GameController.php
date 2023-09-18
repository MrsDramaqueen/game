<?php

namespace App\Http\Controllers;

use App\Entity\Monster\ListMonsters;
use App\Entity\Obstacle\ListObstacles;
use App\Services\Game\GameService;
use App\Services\Game\LogService;
use App\Services\Game\NewGame;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class GameController extends Controller
{
    public function menu()
    {
        return view('game/start');
    }

    public static function start(NewGame $newGame, GameService $gameService): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $player = \App\Entity\Player\Player::getInstance();
        $board = \App\Entity\Board\Board::getInstance();
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

    public static function getViewGameOver()
    {
        return \view('gameOver');
    }

    /**
     * @return string
     */
    public static function getViewBoard(): string
    {
        $player = \App\Entity\Player\Player::getInstance();
        $board = \App\Entity\Board\Board::getInstance();
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

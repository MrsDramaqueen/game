<?php

namespace App\Services\Player;

use App\Entity\Obstacle\ListObstacles;
use App\Http\Controllers\GameController;
use \App\Models\Player;
use App\Services\Game\GameService;
use App\Services\Game\LogService;
use App\Services\Mediator\MoveMediator;

class PlayerService
{
    public static function setPlayer(Player $player): void
    {
        \App\Entity\Player\Player::getInstance()
            ->setHp($player->getHp())
            ->setDamage($player->getDamage())
            ->setLevel($player->getLevel())
            ->setExp($player->getExp())
            ->setPositionHeight($player->getPositionHeight())
            ->setPositionWidth($player->getPositionWidth());
    }

    /**
     * @param $command
     * @return string
     */
    public function action($command): string
    {
        GameService::index();
        $moveMediator = new MoveMediator(\App\Entity\Player\Player::getInstance());
        //TODO
        $newCommand = ListObstacles::getInstance()->getPositions($moveMediator, $command);

        $this->move($newCommand);
        $this->saveNewStatePlayer();
        return GameController::getViewBoard();
    }

    /**
     * @param $command
     * @return void
     */
    protected function move($command): void
    {
        LogService::log("Player went $command");

        $command = MoveService::getMoveCommand($command, \App\Entity\Player\Player::getInstance());
        $command->execute();

    }

    private function saveNewStatePlayer(): void
    {
        $player = \App\Entity\Player\Player::getInstance();

        /** @var Player $playerModel */
        $playerModel = Player::query()->get()->first();

        $playerModel
            ->setHp($player->getHp())
            ->setDamage($player->getDamage())
            ->setExp($player->getLevel())
            ->setLevel($player->getLevel())
            //->setState($player->getState())
            ->setPositionWidth($player->getPositionWidth())
            ->setPositionHeight($player->getPositionHeight())
            ->save();
    }
}

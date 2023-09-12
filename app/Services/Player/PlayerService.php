<?php

namespace App\Services\Player;

use App\Entity\Monster\ListMonsters;
use App\Entity\Obstacle\ListObstacles;
use App\Http\Controllers\GameController;
use \App\Models\Player;
use App\Services\Game\GameService;
use App\Services\Game\LogService;
use App\Services\Mediator\MoveMediator;
use App\Services\Strategy\LowHPStrategy;

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
            ->setPositionWidth($player->getPositionWidth())
            ->setMana($player->getMana());
    }

    /**
     * @param $command
     * @return string
     */
    public function action($action, $command): string
    {
        GameService::index();
        $player = \App\Entity\Player\Player::getInstance();
        $moveMediator = new MoveMediator($player);
        //TODO
        $newCommand = ListObstacles::getInstance()->getPositions($moveMediator, $command);

        //TODO Продумать логику стратегий + Использовать стратегию с посредником
        /*if ($this->getLowHP($player->getHp()) <= 10) {
            $player->setDamage((new LowHPStrategy())->doDamage($player->getDamage()));
        }*/

        $this->{$action}($newCommand);
        $this->saveNewStatePlayer();
        return GameController::getViewBoard();
    }

    /**
     * @param $command
     * @return void
     */
    protected function move($command): void
    {
        $player = \App\Entity\Player\Player::getInstance();
        LogService::log("Player went $command");
        $command = MoveService::getMoveCommand($command, $player);
        $player->manaRecovery();
        $command->execute();

    }

    protected function battle($command)
    {
        LogService::log("Игрок задействовал $command");

        $command = BattleService::getBattleCommand($command, \App\Entity\Player\Player::getInstance());

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
            ->setMana($player->getMana())
            ->save();
    }

    private function saveNewStateMonsters()
    {

    }

    private function getLowHP($hp)
    {
        return $hp * 0.3;
    }
}

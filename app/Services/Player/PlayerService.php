<?php

namespace App\Services\Player;

use App\Entity\Monster\ListMonsters;
use App\Entity\Obstacle\ListObstacles;
use App\Http\Controllers\GameController;
use App\Models\Monster;
use \App\Models\Player;
use App\Services\Game\GameService;
use App\Services\Game\LogService;
use App\Services\Mediator\MoveMediator;
use App\Services\Monster\MonsterService;
use App\Services\Strategy\LowHPStrategy;
//TODO: Навести порядок
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

        $monsterNearPlayer = $this->getMonsterNearPlayer();

        (new \App\Services\Monster\MonsterService)->action($action, $command, $monsterNearPlayer);

        $this->saveNewStatePlayer();
        $this->saveNewStateMonsters();
        if ($player->getHp() == 0) {
            return GameController::getViewGameOver();
        } else {
            return GameController::getViewBoard();
        }
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

    //TODO: Сделать для монстров паттерн состояние, в зависимости от которого они выбирают команду или стратегию
    // по состоянию с помощью посредника выбирается стратегия, а в стратегии - команда
    protected function battle($command): void
    {
        LogService::log("Игрок задействовал $command");

        $monsterNearPlayer = $this->getMonsterNearPlayer();
        $command = BattleService::getBattleCommand($command, \App\Entity\Player\Player::getInstance(), $monsterNearPlayer);
        $command->execute();
    }

    private function getMonsterNearPlayer()
    {
        $player = \App\Entity\Player\Player::getInstance();
        $monsters = \App\Entity\Monster\ListMonsters::getInstance()->getMonsters();

        //TODO: Подумать над логикой выбора противника, если под условие подойдет больше 1-го + переработать условие
        foreach ($monsters as $monster) {
            if (abs($monster->getPositionHeight() - $player->getPositionHeight()) == 1
                && abs($monster->getPositionWidth() == $player->getPositionWidth())
                || (abs($monster->getPositionWidth() - $player->getPositionWidth()) == 1)
                && abs($monster->getPositionHeight() == $player->getPositionHeight())) {
                return $monster;
            }
        }
    }

    private function saveNewStatePlayer(): void
    {
        $player = \App\Entity\Player\Player::getInstance();

        /** @var Player $playerModel */
        $playerModel = Player::query()->get()->first();

        $playerModel
            ->setHp($player->getHp())
            ->setDamage($player->getDamage())
            ->setExp($player->getExp())
            ->setLevel($player->getLevel())
            //->setState($player->getState())
            ->setPositionWidth($player->getPositionWidth())
            ->setPositionHeight($player->getPositionHeight())
            ->setMana($player->getMana())
            ->save();
    }

    private function saveNewStateMonsters(): void
    {
        $monsters = ListMonsters::getInstance()->getMonsters();

        foreach ($monsters as $monster) {
            $monsterModel = Monster::query()->find($monster->getId());

            $monsterModel->update([
                'hp'=> $monster->getHp(),
                'damage' => $monster->getDamage(),
                'position_width' => $monster->getPositionWidth(),
                'position_height' => $monster->getPositionHeight(),
                'mana' => $monster->getDamage(),
            ]);
        }

    }

    private function getLowHP($hp)
    {
        return $hp * 0.3;
    }
}

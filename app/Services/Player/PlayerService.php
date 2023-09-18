<?php

namespace App\Services\Player;

use App\Entity\Characters;
use App\Entity\Monster\ListMonsters;
use App\Entity\Obstacle\ListObstacles;
use App\Http\Controllers\GameController;
use App\Models\Monster;
use \App\Models\Player;
use App\Services\Game\GameService;
use App\Services\Game\LogService;
use App\Services\Mediator\MoveMediator;
use App\Services\Monster\MonsterService;
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
    public function action(string $action, string $command): string
    {
        GameService::index();
        $player = \App\Entity\Player\Player::getInstance();
        $moveMediator = new MoveMediator($player);
        $newCommand = ListObstacles::getInstance()->getCommand($moveMediator, $command);
        $this->{$action}($newCommand);

        (new MonsterService)->action();

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
    protected function move(string $command): void
    {
        $player = \App\Entity\Player\Player::getInstance();
        LogService::log("Player went $command");
        $command = MoveService::getMoveCommand($command, $player);
        $player->manaRecovery();
        $command->execute();
    }

    protected function battle(string $command): void
    {
        LogService::log("Игрок задействовал $command");
        $monsterNearPlayer = $this->getMonsterNearPlayer();
        $command = BattleService::getBattleCommand($command, \App\Entity\Player\Player::getInstance(), $monsterNearPlayer);
        $command->execute();
    }

    private function getMonsterNearPlayer()
    {
        $player = \App\Entity\Player\Player::getInstance();
        $monsters = ListMonsters::getInstance()->getMonsters();

        //TODO: Подумать над логикой выбора противника, если под условие подойдет больше одного + переработать условие
        foreach ($monsters as $monster) {
            if (abs($monster->getPositionHeight() - $player->getPositionHeight()) == Characters::MIN_DIFF_CELL_FOR_DAMAGE
                && abs($monster->getPositionWidth() == $player->getPositionWidth())
                || (abs($monster->getPositionWidth() - $player->getPositionWidth()) == Characters::MIN_DIFF_CELL_FOR_DAMAGE)
                && abs($monster->getPositionHeight() == $player->getPositionHeight()) && $monster->getHp() != 0) {
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

            $monsterModel
                ->setHp($monster->getHp())
                ->setDamage($monster->getDamage())
                ->setPositionWidth($monster->getPositionWidth())
                ->setPositionHeight($monster->getPositionHeight())
                ->setMana($monster->getMana())
                ->save();
        }
    }

    private function getLowHP($hp)
    {
        return $hp * 0.3;
    }
}

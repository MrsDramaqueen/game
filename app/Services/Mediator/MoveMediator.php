<?php

namespace App\Services\Mediator;

use App\Entity\Player\Player;
use App\Services\Game\LogService;
use App\Services\Monster\MonsterService;
use App\Services\Player\MoveService;

class MoveMediator implements Mediator
{
    private Player $player;

    /**
     * @param Player $player
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
        $this->player->setMediator($this);
    }


    public function notify(object $sender, string $command, array $datas): string
    {
        $positionHeight = $this->player->getPositionHeight();
        $positionWidth = $this->player->getPositionWidth();
        //$command = $event;
        //dd($event);
        if ($command == MoveService::MOVE_UP) {
            foreach ($datas as $data) {
                if ($data['height'] == $positionHeight - 1 && $data['width'] == $positionWidth) {
                    $command = MoveService::MOVE_RIGHT;
                    $this->getLog($command);
                }
            }
        }

        if ($command == MoveService::MOVE_DOWN) {
            foreach ($datas as $data) {
                if ($data['height'] == $positionHeight + 1 && $data['width'] == $positionWidth) {
                    $command = MoveService::MOVE_LEFT;
                    $this->getLog($command);
                }
            }
        }

        if ($command == MoveService::MOVE_LEFT) {
            foreach ($datas as $data) {
                //dd($this->player->getPositionWidth() - 1);
                if ($data['width'] == $positionWidth - 1 && $data['height'] == $positionHeight) {
                    $command = MoveService::MOVE_UP;
                    $this->getLog($command);
                }
            }
        }

        if ($command == MoveService::MOVE_RIGHT) {
            foreach ($datas as $data) {
                if ($data['width'] == $positionWidth + 1 && $data['height'] == $positionHeight) {
                    $command = MoveService::MOVE_DOWN;
                    $this->getLog($command);
                }
            }
        }

        return $command;
    }

    private function getLog($path)
    {
        LogService::log("Игрок обошел препятствие сходив $path");
    }
}

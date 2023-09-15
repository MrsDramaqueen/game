<?php

namespace App\Services\Mediator;

use App\Entity\Player\Player;
use App\Services\Game\LogService;
use App\Services\Monster\MonsterService;
use App\Services\Player\MoveService;

//TODO: Применить к монстрам, чтобы они тоже обходили препятствия
// а еще можно добавить условный куст, в котором монстр будет прятаться и быть в инвизе для игрока
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


    public function notify(object $sender, string $event, array $datas): string
    {
        $positionHeight = $this->player->getPositionHeight();
        $positionWidth = $this->player->getPositionWidth();

        if ($event == MoveService::MOVE_UP) {
            foreach ($datas as $data) {
                if ($data['height'] == $positionHeight - 1 && $data['width'] == $positionWidth) {
                    $event = MoveService::MOVE_RIGHT;
                    $this->getLog($event);
                }
            }
        }

        if ($event == MoveService::MOVE_DOWN) {
            foreach ($datas as $data) {
                if ($data['height'] == $positionHeight + 1 && $data['width'] == $positionWidth) {
                    $event = MoveService::MOVE_LEFT;
                    $this->getLog($event);
                }
            }
        }

        if ($event == MoveService::MOVE_LEFT) {
            foreach ($datas as $data) {
                if ($data['width'] == $positionWidth - 1 && $data['height'] == $positionHeight) {
                    $event = MoveService::MOVE_UP;
                    $this->getLog($event);
                }
            }
        }

        if ($event == MoveService::MOVE_RIGHT) {
            foreach ($datas as $data) {
                if ($data['width'] == $positionWidth + 1 && $data['height'] == $positionHeight) {
                    $event = MoveService::MOVE_DOWN;
                    $this->getLog($event);
                }
            }
        }

        return $event;
    }

    private function getLog($path)
    {
        LogService::log("Игрок обошел препятствие сходив $path");
    }
}

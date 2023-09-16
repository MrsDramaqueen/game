<?php

namespace App\Services\Mediator;

use App\Entity\Characters;
use App\Entity\Player\Player;
use App\Services\Game\LogService;
use App\Services\Monster\MonsterService;
use App\Services\Player\MoveService;

//TODO: Применить к монстрам, чтобы они тоже обходили препятствия
// а еще можно добавить условный куст, в котором монстр будет прятаться и быть в инвизе для игрока
class MoveMediator implements Mediator
{
    private Characters $characters;

    /**
     * @param Characters $characters
     */
    public function __construct(Characters $characters)
    {
        $this->characters = $characters;
        $this->characters->setMediator($this);
    }


    public function notify(object $sender, string $event, array $datas): string
    {
        $positionHeight = $this->characters->getPositionHeight();
        $positionWidth = $this->characters->getPositionWidth();

        //TODO: Тоже можно отрефакторить
        foreach ($datas as $data) {
            if ($event == MoveService::MOVE_UP) {
                $newPosition = $positionHeight - 1;
                //dd($data['height'] == $positionHeight - 1 && $data['width'] == $positionWidth || $positionHeight - 1 <= 0);
                if ($data['height'] == $positionHeight - 1 && $data['width'] == $positionWidth || $positionHeight - 1 <= 0) {
                    $event = MoveService::MOVE_RIGHT;
                    $this->getLog($event);
                }
            }

            if ($event == MoveService::MOVE_DOWN) {
                $newPosition = $positionHeight + 1;
                if ($data['height'] == $positionHeight + 1 && $data['width'] == $positionWidth || $positionHeight + 1 >= 8) {
                    $event = MoveService::MOVE_LEFT;
                    $this->getLog($event);
                }
            }

            if ($event == MoveService::MOVE_LEFT) {
                $newPosition = $positionWidth - 1;
                if ($data['width'] == $positionWidth - 1 && $data['height'] == $positionHeight || $positionWidth - 1 <= 0) {
                    $event = MoveService::MOVE_UP;
                    $this->getLog($event);
                }
            }

            if ($event == MoveService::MOVE_RIGHT) {
                $newPosition = $positionWidth + 1;
                if ($data['width'] == $positionWidth + 1 && $data['height'] == $positionHeight || $positionWidth + 1 >= 8) {
                    $event = MoveService::MOVE_DOWN;
                    $this->getLog($event);
                }
            }
        }

        //dd($event);
        return $event;
    }

    private function getLog($path)
    {
        LogService::log("Игрок обошел препятствие сходив $path");
    }
}

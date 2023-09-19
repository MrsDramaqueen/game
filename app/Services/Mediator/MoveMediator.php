<?php

namespace App\Services\Mediator;

use App\Entity\Characters;
use App\Entity\Player\Player;
use App\Models\Board;
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
                if ($data['height'] == $positionHeight - Board::MINIMUM_COORDINATE && $data['width'] == $positionWidth
                    || $positionHeight - Board::MINIMUM_COORDINATE <= 0) {
                    $event = MoveService::MOVE_RIGHT;
                    $this->getLog($event);
                }
            }

            if ($event == MoveService::MOVE_DOWN) {
                if ($data['height'] == $positionHeight + Board::MINIMUM_COORDINATE && $data['width'] == $positionWidth
                    || $positionHeight + Board::MINIMUM_COORDINATE >= Board::HEIGHT) {
                    $event = MoveService::MOVE_LEFT;
                    $this->getLog($event);
                }
            }

            if ($event == MoveService::MOVE_LEFT) {
                if ($data['width'] == $positionWidth - Board::MINIMUM_COORDINATE && $data['height'] == $positionHeight
                    || $positionWidth - Board::MINIMUM_COORDINATE <= 0) {
                    $event = MoveService::MOVE_UP;
                    $this->getLog($event);
                }
            }

            if ($event == MoveService::MOVE_RIGHT) {
                if ($data['width'] == $positionWidth + Board::MINIMUM_COORDINATE && $data['height'] == $positionHeight
                    || $positionWidth + Board::MINIMUM_COORDINATE >= Board::WIDTH) {
                    $event = MoveService::MOVE_DOWN;
                    $this->getLog($event);
                }
            }
        }

        return $event;
    }

    private function getLog($path)
    {
        LogService::log($this->characters::class . ' ' . $this->characters->getId() . " обошел препятствие сходив $path");
    }
}

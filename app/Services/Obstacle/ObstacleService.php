<?php

namespace App\Services\Obstacle;

use App\Models\BoardPosition;
use App\Models\Obstacle;

class ObstacleService
{
    public static function setObstacle(Obstacle $obstacle): \App\Entity\Obstacle\Obstacle
    {
        $positionWidth = rand(3, 8);
        $positionHeight = rand(3, 8);

        $obstacleBoardPositions = (new BoardPosition())
            ->setEntityId($obstacle->getId())
            ->setEntityType(ENTITY_TYPE_OBSTACLES)
            ->setHeightPosition($obstacle->getPositionHeight())
            ->setWidthPosition($obstacle->getPositionWidth());

        $obstacleBoardPositions->save();

        return (new \App\Entity\Obstacle\Obstacle())
            ->setType($obstacle->getType())
            ->setPositionWidth($obstacleBoardPositions->getWidthPosition())
            ->setPositionHeight($obstacleBoardPositions->getHeightPosition());
    }
}

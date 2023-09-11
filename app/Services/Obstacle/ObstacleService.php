<?php

namespace App\Services\Obstacle;

use App\Models\Obstacle;

class ObstacleService
{
    public static function setObstacle(Obstacle $obstacle): \App\Entity\Obstacle\Obstacle
    {
        $positionWidth = rand(3, 8);
        $positionHeight = rand(3, 8);

        return (new \App\Entity\Obstacle\Obstacle())
            ->setType($obstacle->getType())
            ->setPositionWidth($obstacle->getPositionWidth())
            ->setPositionHeight($obstacle->getPositionHeight());
    }
}

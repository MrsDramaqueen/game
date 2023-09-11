<?php

namespace App\Services\Board;

use App\Models\Board;

class BoardService
{
    public static function setBoard(Board $board): void
    {
        \App\Entity\Board\Board::getInstance()
            ->setWidth($board->getWidth())
            ->setHeight($board->getHeight());
    }
}

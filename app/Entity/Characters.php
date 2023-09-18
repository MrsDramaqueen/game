<?php

namespace App\Entity;

interface Characters
{
    const MOVE_TYPE_COMMAND = 'move';
    const BATTLE_TYPE_COMMAND = 'battle';
    const LEFT_COMMAND = 'left';
    const RIGHT_COMMAND = 'right';
    const UP_COMMAND = 'up';
    const DOWN_COMMAND = 'down';
    const HIT_COMMAND = 'hit';
    const HILL_COMMAND = 'hill';
    const MIN_DIFF_CELL_FOR_DAMAGE = 1;
    const MAX_DIFF_CELL_FOR_DAMAGE = 2;
    const MIN_HP_FOR_HILL = 25;
    const MOVE_COMMAND = [
        self::DOWN_COMMAND => 'down',
        self::LEFT_COMMAND => 'left',
        self::UP_COMMAND => 'up',
        self::RIGHT_COMMAND => 'right',
    ];

    const BATTLE_COMMAND = [
        self::HILL_COMMAND => 'hill',
        self::HIT_COMMAND => 'hit',
    ];

    public function up();
    public function down();
    public function left();
    public function right();
    public function hit();
    public function hill();
    public function stay();
}

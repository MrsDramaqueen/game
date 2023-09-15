<?php

namespace App\Entity;

interface Characters
{
    const LEFT_COMMAND = 'left';
    const RIGHT_COMMAND = 'right';
    const UP_COMMAND = 'up';
    const DOWN_COMMAND = 'down';

    const MOVE_COMMAND = [
        self::DOWN_COMMAND => 'down',
        self::LEFT_COMMAND => 'right',
        self::UP_COMMAND => 'up',
        self::RIGHT_COMMAND => 'right',
    ];

    public function up();
    public function down();
    public function left();
    public function right();
    public function hit();
    public function hill();
}

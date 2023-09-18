<?php

namespace App\Services\Game;

use App\Models\Board;
use App\Models\Monster;
use App\Models\Obstacle;
use App\Models\Player;
use Faker\Generator;

class NewGame
{
    public function __construct(protected Generator $generator)
    {
        if (!Player::query()->get()->first()) {
            $this->generatePlayer();
            $this->generateBoard();
            $this->generateMonsters(2);
            $this->generateObstacles(2);
        }
    }

    private function generatePlayer(): void
    {
        (new Player())
            ->setHp(Player::HP)
            ->setExp(Player::EXP)
            ->setDamage(Player::DAMAGE)
            ->setLevel(Player::LEVEL)
            ->setPositionHeight(Player::HEIGHT_DEFAULT)
            ->setPositionWidth(Player::WIDTH_DEFAULT)
            ->setMana(Player::MAX_MANA)
            ->save();
    }

    private function generateBoard(): void
    {
        (new Board())
            ->setHeight(Board::HEIGHT)
            ->setWeight(Board::WIDTH)
            ->save();
    }

    private function generateMonsters(int $repeat): void
    {
        /** @var Board $board */
        $board = Board::query()->get()->first();

        for ($i = 1; $i <= $repeat; $i++) {

            [$width, $height] = $this->generatePositions($board->getWidth());

            (new Monster())
                ->setType($this->generator->randomElement(Monster::MONSTER_TYPE))
                ->setHp(Monster::MONSTER_HP)
                ->setDamage(Monster::MONSTER_DAMAGE)
                ->setMana(Monster::MONSTER_MANA)
                ->setPositionWidth($width)
                ->setPositionHeight($height)
                ->save();

        }
    }

    private function generateObstacles(int $repeat): void
    {
        /** @var Board $board */
        $board = Board::query()->get()->first();

        for ($i = 1; $i <= $repeat; $i++) {

            [$width, $height] = $this->generatePositions($board->getWidth());

            (new Obstacle())
                ->setType($this->generator->randomElement(Obstacle::OBSTACLE_TYPE))
                ->setPositionWidth($width)
                ->setPositionHeight($height)
                ->save();
        }
    }

    private function generatePositions(int $max, int $min = Board::MINIMUM_COORDINATE): array
    {
        $width = $this->generator->numberBetween($min , $max);
        $height = $this->generator->numberBetween($min, $max);

        $enemyPosition = Monster::query()->where('position_width', $width)->exists();
        $playerPosition = Player::query()->where('position_width', $width)->exists();
        $obstaclePosition = Obstacle::query()->where('position_width', $width)->exists();

        if ($enemyPosition || $playerPosition || $obstaclePosition) {
            return $this->generatePositions($max);
        }
        return [$width, $height];
    }
}

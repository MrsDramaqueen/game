<?php

namespace App\Providers;

use App\Models\Monster;
use App\Models\Obstacle;
use App\Models\Player;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->defaultConstants();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    public function defaultConstants()
    {
        defined('ENTITY_TYPE_MONSTERS') ?: define('ENTITY_TYPE_MONSTERS', 'monster');
        defined('ENTITY_TYPE_PLAYERS') ?: define('ENTITY_TYPE_PLAYERS', 'player');
        defined('ENTITY_TYPE_OBSTACLES') ?: define('ENTITY_TYPE_OBSTACLES', 'obstacle');
        defined('GAME_MODE_SURVIVE') ?: define('GAME_MODE_SURVIVE', 'survive');
        defined('GAME_MODE_NORMAL') ?: define('GAME_MODE_NORMAL', 'normal');



        Relation::morphMap([
            ENTITY_TYPE_MONSTERS => Monster::class,
            ENTITY_TYPE_PLAYERS => Player::class,
            ENTITY_TYPE_OBSTACLES => Obstacle::class,
        ]);
    }
}

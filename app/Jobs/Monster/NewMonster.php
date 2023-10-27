<?php

namespace App\Jobs\Monster;

use App\Models\Monster;
use App\Services\Game\LogService;
use App\Services\Monster\MonsterService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewMonster implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Monster $monster;

    /**
     * Create a new job instance.
     */
    public function __construct(Monster $monster)
    {
        $this->monster = $monster;
    }

    /**
     * Execute the job.
     */
    public function handle(): \App\Entity\Monster\Monster
    {
        LogService::log('new monster');
        return MonsterService::setMonster($this->monster);
    }
}

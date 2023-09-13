<?php

namespace App\Http\Controllers;

use App\Http\Requests\MoveRequest;
use App\Services\Player\PlayerService;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * @param MoveRequest $request
     * @param PlayerService $service
     * @return string
     */
    public function move(MoveRequest $request, PlayerService $service): string
    {
        return $service->action(__FUNCTION__, $request->getAction());
    }

    public function battle(MoveRequest $request, PlayerService $service): string
    {
        return $service->action(__FUNCTION__, $request->getAction());
    }
}

<?php

namespace App\Services\Mediator;

interface Mediator
{
    public function notify(object $sender, string $command, array $datas);
}

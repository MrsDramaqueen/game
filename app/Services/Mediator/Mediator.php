<?php

namespace App\Services\Mediator;

interface Mediator
{
    //TODO: Возможно переделать для всех посредников
    public function notify(object $sender, string $command, array $datas);
}

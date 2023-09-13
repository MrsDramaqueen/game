<?php

namespace App\Services\Strategy;

interface Strategy
{
    //TODO: Перекинуть перерасчет параметров в состояние
    public function doDamage($data);

    public function doHill($data);

    public function doStrategyActions();
}

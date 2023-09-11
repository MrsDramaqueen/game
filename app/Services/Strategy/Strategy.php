<?php

namespace App\Services\Strategy;

interface Strategy
{
    public function doDamage($data);

    public function doHill($data);
}

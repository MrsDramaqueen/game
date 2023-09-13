<?php

namespace App\Entity;

interface Characters
{
    public function up();
    public function down();
    public function left();
    public function right();
    public function hit();
    public function hill();
}

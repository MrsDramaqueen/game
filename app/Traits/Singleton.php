<?php

namespace App\Traits;

trait Singleton
{
    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance(): static
    {
        return is_null(self::$instance)
            ? self::$instance = new static()
            : self::$instance;
    }
}

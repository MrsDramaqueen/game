<?php

namespace App\Services\Game;

use App\Traits\Singleton;

class LogService
{
    use Singleton;

    private $logFile;

    protected function __construct()
    {
        $this->logFile = fopen('../storage/logs/game_logs', 'a');
    }

    public function writeLog(string $message): void
    {
        $date = date('Y-m-d H:i:s');
        fwrite($this->logFile, "$date: $message\n");
    }

    public static function log(string $message): void
    {
        $logger = static::getInstance();
        $logger->writeLog($message);
    }
}

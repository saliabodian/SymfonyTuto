<?php

namespace App\Logger;

class Logger
{
    private $processors;

    public function __construct(iterable $processors = [])
    {
        $this->processors = $processors;
    }

    public function log(string $message)
    {
        $log = [
            'message' => $message,
        ];

        foreach ($this->processors as $processor) {
            $log = $processor->processLog($log);
        }

        return $log;
    }
}

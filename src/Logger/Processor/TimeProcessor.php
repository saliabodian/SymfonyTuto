<?php

namespace App\Logger\Processor;

class TimeProcessor implements ProcessorInterface
{
    public function processLog(array $log): array
    {
        $log['time'] = date('Y-m-d H:i:s');

        return $log;
    }
}

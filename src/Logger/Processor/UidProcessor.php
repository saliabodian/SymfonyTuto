<?php

namespace App\Logger\Processor;

class UidProcessor implements ProcessorInterface
{
    public function __construct($uid = null)
    {
        $this->uid = $uid ?: bin2hex(random_bytes(10));
    }

    public function processLog(array $log): array
    {
        $log['uid'] = $this->uid;

        return $log;
    }
}

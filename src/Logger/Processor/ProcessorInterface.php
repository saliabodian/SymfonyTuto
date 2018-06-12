<?php

namespace App\Logger\Processor;

interface ProcessorInterface
{
    public function processLog(array $log): array;
}

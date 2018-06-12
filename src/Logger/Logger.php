<?php

namespace App\Logger;

use App\Logger\Processor\ProcessorInterface;

class Logger
{
    private $processors;

    public function __construct(iterable $processors = [])
    {
        foreach ($processors as $processor) {
            if (!$processor instanceof ProcessorInterface) {
                throw new \InvalidArgumentException(sprintf('The processor is not an instance of %s.', ProcessorInterface::class));
            }
        }

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

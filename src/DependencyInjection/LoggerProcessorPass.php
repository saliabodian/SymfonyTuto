<?php

namespace App\DependencyInjection;

use App\Logger\Logger;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class LoggerProcessorPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $processorsDefinition = $container->findTaggedServiceIds('app.logger.processor');
        $processorsReference = [];
        foreach ($processorsDefinition as $id => $_) {
            $processorsReference[] = new Reference($id);
        }

        $container
            ->getDefinition(Logger::class)
            ->setArguments([$processorsReference])
        ;
    }
}

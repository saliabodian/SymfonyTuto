<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class RainbowExtension extends AbstractExtension
{
    private const COLORS = [
        '#FF0000',
        '#E2571E',
        '#FF7F00',
        '#FFFF00',
        '#00FF00',
        '#96bf33',
        '#0000FF',
        '#4B0082',
        '#8B00FF',
        '#ffffff',
    ];

    public function getFilters(): array
    {
        return [
            new TwigFilter('rainbow', [$this, 'rainbow'], ['is_safe' => ['html']]),
        ];
    }

    public function rainbow(string $string): string
    {
        $letters = preg_split('//u', $string);

        $output = '';
        $i = 0;
        foreach ($letters as $letter) {
            if ('' === $letter) {
                continue;
            }
            $output .= sprintf('<span style="color:%s">%s</span>', self::COLORS[$i++ % 10], $letter);
        }

        return $output;
    }
}

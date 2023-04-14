<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('snake', [$this, 'formatSnake']),
        ];
    }

    public function formatSnake(string $s)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $s));
    }
}
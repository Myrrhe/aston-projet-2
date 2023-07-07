<?php

namespace App\Service;

class StringService
{
    public function trimSlash(string $s): string
    {
        return preg_replace('/^.*\\\s*/', '', $s);
    }
}

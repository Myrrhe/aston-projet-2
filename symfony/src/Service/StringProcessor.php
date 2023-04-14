<?php

namespace App\Service;

class StringProcessor
{
    public function trimSlash(string $s): string
    {
        return preg_replace('/^.*\\\s*/', '', $s);
    }
}

<?php

namespace App\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;

class AppExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct()
    {
        // Inject dependencies if needed
    }

    public function doSomething(int $count, string $singular,string $plural ):sting
    {
        $str = $count=== 1 ? $singular : $plural;
        // ...
        return "$count $t";
    }
}
<?php

namespace App\Base;

use Twig\RuntimeLoader\RuntimeLoaderInterface;

class TwigRuntimeLoader implements RuntimeLoaderInterface
{

    public function load(string $class)
    {
        return new TwigRuntimeExtension;
    }

}

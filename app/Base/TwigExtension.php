<?php

namespace App\Base;

use Twig\Extension\GlobalsInterface;
// use Twig\TwigFilter;
// use Twig\TwigFunction;
use App\Base\AbstractTwig;

class TwigExtension extends AbstractTwig implements GlobalsInterface
{

    public function getGlobals() : array
    {
        return [
            'old' => $this->getOldInput(),
            'errors' => $this->getErrors(),
            'flash' => $this->getFlash(),
            'csrf' => $this->getCsrf()
        ];
    }

    // public function getFilters() : array
    // {
        // return [
        //     new TwigFilter('twig_function_name', 'php_function_name'),
        // ];
    // }

    // public function getFunctions() : array
    // {
        // return [
        //     new TwigFunction('twig_function_name', 'php_function_name'),
        //     new TwigFunction('twig_function_name', [TwigRuntimeExtension::class, 'runtime_extension_function_name'])
        // ];
    // }

}
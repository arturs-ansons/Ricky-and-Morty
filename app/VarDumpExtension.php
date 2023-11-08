<?php

namespace MvcApp;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
class VarDumpExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('vardump', [$this, 'varDump']),
        ];
    }

    public function varDump($var)
    {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        return $output;
    }
}

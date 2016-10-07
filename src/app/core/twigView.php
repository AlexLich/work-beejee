<?php
namespace App\Core;

use Twig_Environment;
use Twig_Loader_Filesystem;

class TwigView
{
    private $twig;

    public function __construct($template, $params)
    {
        $loader = new Twig_Loader_Filesystem($template);
        $this->twig = new Twig_Environment($loader, $params);
    }

    public function render($template, $params = array())
    {
        echo $this->twig->render($template, $params);
    }
}

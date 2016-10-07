<?php
namespace App\Core;
class Controller
{
    public $model;
    public $view;

    function __construct()
    {
        $template = array('src/app/views','src/app/views/templates');

        $params = array(
			'cache' => "tmp/cache",
			'auto_reload' => true,
			'autoescape' => true
		);

        $this->view = new TwigView($template, $params);
    }
}

<?php

/**
 * The home page view
 */
class IndexView
{

    private $model;

    private $controller;

    function __construct($controller, $model)
    {
        $this->controller = $controller;

        $this->model = $model;

        print "Home - ";
    }

    public function index()
    {
        return $this->controller->sayWelcome();
    }

    public function action()
    {
        return $this->controller->takeAction();
    }
}

<?php

/**
 * The about page view
 */
class AboutView
{

    private $modelObj;

    private $controller;

    function __construct($controller, $model)
    {
        $this->controller = $controller;
        echo "<pre>";
        $this->modelObj = $model;
        print_r([$this->modelObj->nowADays(),$this->modelObj]);
        print "About - ";
    }

    public function now()
    {
        return $this->modelObj->nowADays();
    }

    public function today()
    {
        return $this->controller->current();
    }
    public function saif($params = null, $params2 = null)
    {
        print_r($params);
        print_r($params2);
        return "hello";
    }
}

<?php
require_once __DIR__.'/IndexController.php';
require_once __DIR__.'/SaifController.php';
require_once __DIR__ . '/../Models/Model.php';

class Controller
{
    public $model;
    public function __construct($params = null)
    {
        $this->model = new Model;
    }

    function view($fileName,$data=null)
    {
        if ($data) {
            extract($data);
        }
        ob_start();
        include(__DIR__ . '/../Views/' . $fileName . '.php');
        $var = ob_get_contents();
        ob_end_clean();
        print $var;
    }
}

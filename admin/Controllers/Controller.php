<?php
require_once __DIR__ . env("APP_ADMIN_NAME") . '/../Models/Model.php';

class Controller
{
    public $model;
    public function __construct($params = null)
    {
        $this->model = new Model;
    }

    function view($fileName, $data = null)
    {
        if ($data) {
            extract($data);
        }
        ob_start();

        include(__DIR__ . env("APP_ADMIN_NAME") . '/../Views/' . $fileName . '.php');
        $var = ob_get_contents();
        ob_end_clean();
        print $var;
    }

    public function slug($string)
    {
        $slug = strtolower(trim(preg_replace("/[\s-]+/", "-", preg_replace("/[^a-zA-Z0-9\-]/", '-', addslashes($string))), "-"));
        return $slug;
    }
}

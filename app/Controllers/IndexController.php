<?php
include __DIR__ . '/../Models/IndexModel.php';
include __DIR__.'/Controller.php';

class IndexController
{
    public $model;
    public function __construct($params = null)
    {
        $this->model = new IndexModel;
    }

    public function index()
    {
        view('test');
    }

    public function saif()
    {
        echo "working good";
    }

    
}

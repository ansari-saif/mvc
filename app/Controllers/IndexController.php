<?php
include __DIR__ . '/../Models/IndexModel.php';
include __DIR__.'/Controller.php';

class IndexController extends Controller
{
    public $model;
    public function __construct($params = null)
    {
        $this->model = new IndexModel;
    }

    public function index()
    {
        $this->view('test',['data'=>'working fine']);
    }

    public function saif()
    {
        echo "working good";
    }

    
}

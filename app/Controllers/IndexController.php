<?php

class IndexController extends Controller
{

    public function index()
    {
        $this->view('test',['data'=>'working fine']);
    }

    public function saif()
    {
        echo "working good";
    }

}

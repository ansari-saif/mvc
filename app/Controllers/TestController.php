<?php

class TestController extends Controller
{

    public function index()
    {
        echo "this is test controller";
    }

    public function test()
    {
        $numRecord = 10;
        $data = $this->model->paginate("SELECT name,email,mobile FROM query  order by id desc", $numRecord);
        $pagination = $this->paginationHtml($data['total_count'], $numRecord);
        $this->view("test", [
            "data" => $data['data'],
            "pagination" => $pagination
        ]);
    }
}

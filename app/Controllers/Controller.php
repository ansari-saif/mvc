<?php
require_once __DIR__ . '/../Models/Model.php';

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
        include(__DIR__ . '/../Views/' . $fileName . '.php');
        $var = ob_get_contents();
        ob_end_clean();
        print $var;
    }

    public function slug($string)
    {
        $slug = strtolower(trim(preg_replace("/[\s-]+/", "-", preg_replace("/[^a-zA-Z0-9\-]/", '-', addslashes($string))), "-"));
        return $slug;
    }

    public function paginationHtml($data)
    {
        $adjacents = 3;
        $page = $data['current_page'];
        $targetpage = '';
        if ($page == 0) $page = 1;
        $prev = $page - 1;
        $next = $page + 1;
        $lastpage = $data['last_page'];
        $lpm1 = $lastpage - 1;
        $pagination = "";
        if ($lastpage > 1) {
            if ($page > 1)
                $pagination .= "<a href=\"$targetpage?page=$prev\"> Prev </a>";
            else
                $pagination .= " <a href=\"#\"> Prev </a>";
            //pages
            if ($lastpage < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up
            {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<a href=\"\" class=\"active\"> $counter </a>";
                    else
                        $pagination .= "<a href=\"$targetpage?page=$counter\"> $counter </a>";
                }
            } elseif ($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
            {
                //close to beginning; only hide later pages
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $pagination .= "<a href=\"\" class=\"active\"> $counter </a>";
                        else
                            $pagination .= "<a href=\"$targetpage?page=$counter\"> $counter </a>";
                    }
                    $pagination .= "<a href=\"$targetpage?page=$lpm1\"> $lpm1 </a>";
                    $pagination .= "<a href=\"$targetpage?page=$lastpage\"> $lastpage </a>";
                }
                //in middle; hide some front and some back
                elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $pagination .= "<a href=\"$targetpage?page=1\">1</a>";
                    $pagination .= "<a href=\"$targetpage?page=2\">2</a>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<a href=\"\" class=\"active\"> $counter </a>";
                        else
                            $pagination .= "<a href=\"$targetpage?page=$counter\"> $counter </a>";
                    }
                    $pagination .= "<a href=\"$targetpage?page=$lpm1\"> $lpm1 </a>";
                    $pagination .= "<a href=\"$targetpage?page=$lastpage\"> $lastpage</a>";
                }
                //close to end; only hide early pages
                else {
                    $pagination .= "<a href=\"$targetpage?page=1\"> 1 </a>";
                    $pagination .= "<a href=\"$targetpage?page=2\"> 2 </a>";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<a href=\"\" class=\"active\"> $counter </a>";
                        else
                            $pagination .= "<a href=\"$targetpage?page=$counter\"> $counter </a>";
                    }
                }
            }
            //next button
            if ($page < $counter - 1)
                $pagination .= "<a href=\"$targetpage?page=$next\"> Next  </a>";
            else
                $pagination .= "<a href=\"#\"> Next</a>";
        }
        return $pagination;
    }
}

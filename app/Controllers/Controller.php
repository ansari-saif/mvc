<?php
function view($fileName)
{
    ob_start();
    include(__DIR__ . '/../Views/' . $fileName . '.php');
    $var = ob_get_contents();
    ob_end_clean();
    print $var;
}

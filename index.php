<?php

$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/';

require_once __DIR__ . '/code.php';

$projectName = (isset($url[0]) && ($url[0] == env("APP_ADMIN_URL"))) ? env("APP_ADMIN_NAME") : env("APP_NAME");

require_once __DIR__ . '/' . $projectName . '/Controllers/Controller.php';
if ($url == '/') {
    require_once __DIR__ . '/' . $projectName . '/Controllers/IndexController.php';
    $indexController = (new IndexController)->index();
} else {
    $requestedController = $url[0];
    $requestedAction = isset($url[1]) ? $url[1] : '';
    $requestedParams = array_slice($url, 2);
    if ($requestedController == env("APP_ADMIN_URL")) {
        if (isset($url[1])) {
            $requestedController = $url[1];
        } else {
            require_once __DIR__ . '/' . $projectName . '/Controllers/IndexController.php';
            $indexController = (new IndexController)->index();
            return 0;
        }
        $requestedAction = isset($url[2]) ? $url[2] : '';
        $requestedParams = array_slice($url, 3);
    }
    $ctrlPath = __DIR__ . '/' . $projectName . '/Controllers/' . ucfirst($requestedController) . 'Controller.php';
    if (file_exists($ctrlPath)) {
        require_once __DIR__ . '/' . $projectName . '/Controllers/' . ucfirst($requestedController) . 'Controller.php';
        $controllerName = ucfirst($requestedController) . 'Controller';
        if ($requestedAction != '') {
            (new $controllerName())->$requestedAction($requestedParams);
        } else {
            (new $controllerName())->index();
        }
    } else {
        header('HTTP/1.1 404 Not Found');
        die('404 - The file - ' . $ctrlPath . ' - not found');
    }
}

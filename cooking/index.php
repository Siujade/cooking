<?php

include "./config/config.php";
session_start();

spl_autoload_register(function ($class) {
    if(file_exists("./controllers/$class.php")){
        include_once "./controllers/$class.php";
    } else {
        include_once "./models/$class.php";
    }
});

$request = $_SERVER['REQUEST_URI'];
$components = explode('/', parse_url($request, PHP_URL_PATH));
$controllerValue = getComponentValue($components, 2, DEFAULT_CONTROLLER);
$actionValue = getComponentValue($components, 3, DEFAULT_ACTION);
$controllerName = ucfirst(strtolower($controllerValue)) . "Controller";
$controllerPath = "./controllers/" . $controllerName . ".php";
$params = array_splice($components, 4);

if (file_exists($controllerPath) && $controllerName != 'MainController') {
    $controller = new $controllerName();
} else {
    $controller = new DefaultController(DEFAULT_CONTROLLER);
}

if (method_exists($controller, $actionValue)) {
       call_user_func(array($controller, $actionValue), $params);

} else {
    $actionValue = DEFAULT_ACTION;
}

$controller->renderView($actionValue);

function getComponentValue($components, $index, $default)
{
    $component = $default;

    if (count(array_filter($components)) >= $index) {
        $component = $components[$index];
    }

    return $component;
}
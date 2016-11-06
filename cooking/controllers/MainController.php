<?php

abstract class MainController
{
    protected $layout = DEFAULT_LAYOUT;
    protected $isPost;

    public function __construct()
    {
        $this->onInit();
        $this->index();

        if($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->isPost = true;
        }
    }

    public function index(){ }

    protected function onInit()
    {
        $this->title = preg_replace('/Controller/', '', get_class($this));
    }

    public function renderView($action = 'index')
    {
        $controller = preg_replace('/Controller/', '', get_class($this));
        $layoutName = $this->layout;

        if ($controller == 'Default') {
            $controller = DEFAULT_CONTROLLER;
        }

        $controller = strtolower($controller);

        include_once("./views/layouts/$layoutName/header.php");
        include_once("./views/$controller/$action.php");
        include_once("./views/layouts/$layoutName/footer.php");
    }

    public function redirectTo($url = '/'){
        header('Location: ' . $url);
    }


    public function checkAuth($redirect = true){
        if(empty($_SESSION['name']) && $redirect) {
            $this->redirectTo('/cooking');
            die();
        }

        return empty($_SESSION['name']) ? false : true;
    }
} 
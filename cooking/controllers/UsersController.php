<?php

class UsersController extends MainController
{
    private $model;

    public function index() {
        $this->model = new UsersModel();
    }

     public function register() {
        $this->reg_result = $this->model->register();
     }

     public function login() {
        if($this->isPost) {
           $result = $this->model->login();

            if($result) {
                $_SESSION['name'] = $result['name'];
                $_SESSION['id'] = $result['user_id'];

                $this->redirectTo('/cooking/');
            } else {
                echo "Incorrect login!";
            }
        }
     }

    public function logout() {
         session_destroy();
         $this->redirectTo('/cooking/');
    }
} 
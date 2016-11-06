<?php

class ArticlesController extends MainController
{
    private $model;

    public function index()
    {
        $this->model = new ArticlesModel();
        $this->articles = $this->model->getAllArticles();
        //$this->comments = $this->model->getAllComments();
    }

    public function  create(){
        $this->checkAuth();
        $this->articles = $this->model->create();
     //   $this->redirectTo('/cooking');
    }

    public function comment(){
        $this->checkAuth();
        $this->model->comment();
        $this->redirectTo('/cooking');
    }

    public function getComments($article_id) {
        return $this->model->getAllComments($article_id);
    }

    public function delete($param){
        $this->checkAuth();
        $this->model->delete($param);
    }

    public function renderView($action = 'index'){
        if(in_array($action, array('delete','comment'))) {
            parent::renderView('index');
        } else {
            parent::renderView($action);
        }
    }
}
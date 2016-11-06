<?php

class ArticlesModel extends MainModel
{
    //Select methods
    public static function getAllArticles()  {
        $orderby = array('a.article_id DESC');
        $join = "JOIN users u ON u.user_id = a.author_id";
        $result = parent::select('articles a', 'a.*,u.name', null, $orderby, $join);

        return $result;
    }

    public static function getAllComments($article_id) {
        $orderby = array('c.comment_id DESC');
        $join = "JOIN users u ON u.user_id = c.author";
        $where = array('article_id'=>$article_id);
        $result = parent::select('comments c', 'c.*,u.name', $where, $orderby, $join);

        return $result;
    }

    //Insert methods
    public static function create(){
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
        $tags = filter_input(INPUT_POST, 'tags', FILTER_SANITIZE_SPECIAL_CHARS);
        $author = $_SESSION['id'];

        if(empty($title)) {
            return false;
        }

        $tmpName = $_FILES['image']['tmp_name'];
        $fp = fopen($tmpName, 'rb');

        $sql = "INSERT INTO articles (title,content,tags,author_id,image) values(?,?,?,?,?)";
        $q = parent::$connection->prepare($sql);
        $q->bindParam(1, $title);
        $q->bindParam(2, $content);
        $q->bindParam(3, $tags);
        $q->bindParam(4, $author);
        $q->bindParam(5, $fp, PDO::PARAM_LOB);

       return  $q->execute();
    }

    public static function comment(){
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
        $author = $_SESSION['id'];
        $data = array('article_id'=>$id,'content'=>$content,'author'=>$author);

        return parent::insert('comments', $data);
    }

    //Delete methods
    public static function delete($param, $fields = array()){
        return parent::delete('articles', $param);
    }
} 
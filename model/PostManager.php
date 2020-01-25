<?php

/**
 * Description of PostManager
 *
 * @author Voy
 */
require_once("model/Manager.php");

class PostManager extends Manager {

    public function showChapters($cPage, $postsPerPage) {
        $db = $this->dbConnect();
        $req = $db->query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS creation_date_fr FROM chapter ORDER BY creation_date DESC LIMIT $cPage, $postsPerPage");
        $posts = $req->fetchAll();
        
        return $posts;
    }

    public function getPost($postId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM chapter WHERE id ='.$postId);
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

}

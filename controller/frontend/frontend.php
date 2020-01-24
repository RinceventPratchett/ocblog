<?php

// class loading
require_once(MODEL_DIR . '/PostManager.php');
require_once(MODEL_DIR . '/CommentManager.php');
require_once(MODEL_DIR . '/AdminManager.php');
require_once(MODEL_DIR . '/Pagination.php');

class FrontEndController {
    
    function login() {  //page containing the connexion form
        require(FRONT_VIEW_DIR . '/loginView.php');
    }

    function signIn() {

        $signIn = (new AdminManager)->signIn();

        if ($signIn) {
            header('Location: index.php');
        }
        throw new Exception('Impossible de se connecter !');
        echo '<a class="btn btn-info linkAdmin" href="index.php">Retour à la liste des billets</a>';
    }

    function signOut() {
        if ($_SESSION['adminLogged']){
            
            $signOut = (new AdminManager)->signOut();
            header('Location: index.php');
        }

    }

    function listPosts() {//List the different chapters on IndexView
        $postManager = new PostManager();
        $pagination = new Pagination();

        $postsPerPage = 6;
        
        $nbPosts = $pagination->getPostsPagination();
        $nbPage = $pagination->getPostsPages($nbPosts, $postsPerPage);
        
        if (!isset($_GET['page'])) {
            $cPage = 0;
        } else {
            if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPage) {
                $cPage = (intval($_GET['page']) - 1) * $postsPerPage;
            }
        }
        if (isset($cPage)) {
            $posts = $postManager->showChapters($cPage, $postsPerPage);
        }else{
            header('Location: index.php');
        }
        require(FRONT_VIEW_DIR . '/indexView.php');
    }

    function postDetails() { //Show one chapter and existing comments depending of

        $post = (new PostManager)->getPost($_GET['id']);
        $comments = (new CommentManager)->showComments($_GET['id']);

        if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] <= $post){        
            require(FRONT_VIEW_DIR . '/postView.php');
        } else {
            header('Location: index.php');
        }        
    }

    function addComment($postId, $author, $comment) {

        $affectedLines = (new CommentManager)->newComment($postId, $author, $comment);
        
        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: index.php?action=showPost&id=' . $postId);
        }
    }

    function reportComment($commentId, $chapterId) {

        $affectedLines = (new CommentManager)->reportComment($commentId, $chapterId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de signaler le commentaire (reportComment->frontend)');
        } else {

            header('Location: index.php?action=showPost&id=' . $chapterId);
        }
    }
}
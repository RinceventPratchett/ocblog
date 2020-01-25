<?php

//class loading

require_once(MODEL_DIR . '/AdminManager.php');
require_once(MODEL_DIR . '/PostManager.php');
require_once(MODEL_DIR . '/CommentManager.php');
require_once(MODEL_DIR . '/Pagination.php');

class BackEndController {   

    function adminView() { //Equivalent of postView, qtty of reports done if existing are presents
        
        $post = (new PostManager)->getPost($_GET['id']);
        $comments = (new CommentManager)->showComments($_GET['id']);
        $reportedComment = (new AdminManager)->reportPending($_GET['id']);
        
        if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] <= $post){
            require(BACK_VIEW_DIR . '/adminView.php');
        } else {
            header('Location: index.php');
        }
    }

    function editChapterView() {

        $post = (new PostManager)->getPost($_GET['id']);
        $comments = (new CommentManager)->showComments($_GET['id']);
        
         if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['id'] <= $post){
            require(BACK_VIEW_DIR . '/editChapterView.php');
        } else {
            header('Location: index.php?action=adminView&id=' . $post);
        }
    }

    function addChapterView() {
        require(BACK_VIEW_DIR . '/addChapterView.php');
    }

    function addChapter($chapterTitle, $chapterContent) {

        $affectedLines = (new AdminManager)->newChapter($chapterTitle, $chapterContent);
        
        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le chapitre !');
        } else {
            header('Location: index.php');
        }
    }

    function editChapter($chapterTitle, $chapterContent, $chapterId) {

        $affectedLines = (new AdminManager)->updateChapter($chapterTitle, $chapterContent, $chapterId);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'editer le chapitre !');
        } else {
            header('Location: index.php?action=adminView&id=' . $chapterId);
        }
    }

    function moderateComment($commentId, $postId) { //to delete a comment reported

        $affectedLines = (new AdminManager)->deleteComment($commentId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer le commentaire !');
        } else {
            header('Location: index.php?action=adminView&id=' . $postId);
        }
    }

    function showReportedComment($commentId, $postId) { //show the reported comments depending of 1 chapter 

        $req = (new AdminManager)->reportPending($_GET['id']);

        if ($req->rowCount() != 0) { //test if the request get 1 results minimum
  
            $post = (new PostManager)->getPost($_GET['id']);
            $comments = $req->fetchAll();    

            require(BACK_VIEW_DIR . '/adminComment.php');

        } else {

            header('Location: index.php?action=adminView&id=' . $commentId);
        }
    }

    function showAllReportedComment($commentId) { //resume of all reported comments existing

        $comments = (new AdminManager)->showReportPending($commentId);

        if ($comments->rowCount() != 0) { 
            require(BACK_VIEW_DIR . '/adminAllComment.php');
            
        } else { ?> 

            <script>alert("pas de commentaire à modérer");</script>
            <br /><a class="btn btn-secondary" href="/index.php">Retour à la liste des billets</a>
            
        <?php }
    }

    function removeChapter($postId) {  //feature to delete an existing chapter

        $affectedLines = (new AdminManager)->deleteChapter($postId);

        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer le chapitre !');
        } else {
            header('Location: index.php?action=indexView');
        }
    }
}
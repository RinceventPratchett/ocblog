<?php

//class loading

require_once(MODEL_DIR . '/AdminManager.php');
require_once(MODEL_DIR . '/PostManager.php');
require_once(MODEL_DIR . '/CommentManager.php');
require_once(MODEL_DIR . '/Pagination.php');

class BackEndController {   

    function adminView() { //Equivalent of postView, qtty of reports done if existing
        $postManager = new PostManager();
        $post = $postManager->getPost($_GET['id']);
        $commentManager = new CommentManager();
        $comments = $commentManager->showComments($_GET['id']);
        $AdminManager = new AdminManager();
        $reportedComment = $AdminManager->reportPending($_GET['id']);

        require(BACK_VIEW_DIR . '/adminView.php');
    }

    function editChapterView() {
        $postManager = new PostManager();
        $post = $postManager->getPost($_GET['id']);
        $commentManager = new CommentManager();
        $comments = $commentManager->showComments($_GET['id']);

        require(BACK_VIEW_DIR . '/editChapterView.php');
    }

    function addChapterView() {
        require(BACK_VIEW_DIR . '/addChapterView.php');
    }

    function addChapter($chapterTitle, $chapterContent) {
        $AdminManager = new AdminManager();
        $affectedLines = $AdminManager->newChapter($chapterTitle, $chapterContent);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le chapitre !');
        } else {
            header('Location: index.php');
        }
    }

    function editChapter($chapterTitle, $chapterContent, $chapterId) {
        $AdminManager = new AdminManager();
        $affectedLines = $AdminManager->updateChapter($chapterTitle, $chapterContent, $chapterId);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'editer le chapitre !');
        } else {
            header('Location: index.php');
        }
    }

    function moderateComment($commentId, $postId) { //to delete a comment reported
        $AdminManager = new AdminManager();
        $affectedLines = $AdminManager->deleteComment($commentId);
        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer le commentaire !');
        } else {
            header('Location: index.php?action=adminView&id=' . $postId);
        }
    }

    function showReportedComment($commentId, $postId) { //show the reported comments depending of 1 chapter 
        $AdminManager = new AdminManager();
        $req = $AdminManager->reportPending($_GET['id']);
        if ($req->rowCount() != 0) { //test si la requete renvoie une ligne minimum
            $postManager = new PostManager();
            $post = $postManager->getPost($_GET['id']);
            $comments = $req->fetchAll();    


            require(BACK_VIEW_DIR . '/adminComment.php');

        } else {

            header('Location: index.php?action=adminView&id=' . $commentId);
        }
    }

    function showAllReportedComment($commentId) { //resume of all reported comments existing
        $AdminManager = new AdminManager();
        $comments = $AdminManager->showReportPending($commentId);
        if ($comments->rowCount() != 0) { //test si la requete renvoie une ligne minimum
            require(BACK_VIEW_DIR . '/adminAllComment.php');
        } else {
            ?>
            <script>alert("pas de commentaire à modérer");</script>

            <br /><a class="btn btn-secondary" href="/index.php">Retour à la liste des billets</a>
            <?php

        }
    }

    function removeChapter($postId) {  //feature to delete an existing chapter
        $AdminManager = new AdminManager();
        $affectedLines = $AdminManager->deleteChapter($postId);
        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer le chapitre !');
        } else {
            header('Location: index.php?action=indexView');
        }
    }
}
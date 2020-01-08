<?php

// Chargement des classes

require_once(MODEL_DIR.'/AdminManager.php');
require_once(MODEL_DIR.'/PostManager.php');
require_once(MODEL_DIR.'/CommentManager.php');



function adminView()
{
    $postManager = new PostManager(); // Création d'un objet
    $post = $postManager->getPost($_GET['id']); // Appel d'une fonction de cet objet
    $commentManager = new CommentManager();
    $comments = $commentManager->showComments($_GET['id']);
    $reportedComment = $commentManager->reportPending($_GET['id']);
    
    require(BACK_VIEW_DIR.'/adminView.php');
}

function editChapterView()
{
    $postManager = new PostManager(); // Création d'un objet
    $post = $postManager->getPost($_GET['id']); // Appel d'une fonction de cet objet
    $commentManager = new CommentManager();
    $comments = $commentManager->showComments($_GET['id']);
    
    require(BACK_VIEW_DIR.'/editChapterView.php');
}

function addChapterView()
{   
    
    require(BACK_VIEW_DIR.'/addChapterView.php');
}

function addChapter($chapterTitle, $chapterContent)
{
    $PostManager = new PostManager();
    $affectedLines = $PostManager->newChapter($chapterTitle, $chapterContent);
     if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le chapitre !');
    }
    else {
        header('Location: index.php');

    }
}

function editChapter($chapterTitle, $chapterContent, $chapterId)
{
    $PostManager = new PostManager();
    
    $affectedLines = $PostManager->updateChapter($chapterTitle, $chapterContent, $chapterId);

     if ($affectedLines === false) {
        throw new Exception('Impossible d\'editer le chapitre ! - frontend - l.85');
    }
    else {
        header('Location: index.php');

    }
}

function moderateComment($commentId, $postId) {
    
    $postManager = new PostManager(); // Création d'un objet
    $post = $postManager->getPost($_GET['id']); // Appel d'une fonction de cet objet
    $CommentManager = new CommentManager();
    $affectedLines = $CommentManager->deleteComment($commentId);
    if ($affectedLines === false) {
        throw new Exception('Impossible de supprimer le commentaire ! - frontend - l.104');
    }
    else {
        header('Location: index.php?action=adminView&id='.$post['id']);
    }
}

function showReportedComment($commentId, $postId) {

    $commentManager = new CommentManager();
    $comments = $commentManager->reportPending($_GET['id']);
    if ($comments->rowCount() != 0) { //test si la requete renvoie une ligne minimum
        $postManager = new PostManager(); 
        $post = $postManager->getPost($_GET['id']); 
        require(BACK_VIEW_DIR.'/adminComment.php');
    }
    else{

        header('Location: index.php?action=adminView&id='.$postId['id']);
    } 
}

function showAllReportedComment($commentId) {
    
    $commentManager = new CommentManager();
    $comments = $commentManager->showReportPending($commentId);
    if ($comments->rowCount() != 0) { //test si la requete renvoie une ligne minimum
        require(BACK_VIEW_DIR.'/adminAllComment.php');

    }
    else{
        echo "pas de commentaire à modérer"; 
?>
        <br /><a class="btn btn-secondary" href="/index.php">Retour à la liste des billets</a>
<?php
    } 
}

function removeChapter($postId) {
    
    $AdminManager = new AdminManager();
    $affectedLines = $AdminManager->deleteChapter($postId);
    if ($affectedLines === false) {
        throw new Exception('Impossible de supprimer le chapitre ! - frontend');
    }
    else {
        header('Location: index.php?action=indexView');
    }
}
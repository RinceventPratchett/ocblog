<?php

function adminView()
{
    $postManager = new PostManager(); // Création d'un objet
    $post = $postManager->getPost($_GET['id']); // Appel d'une fonction de cet objet
    $commentManager = new CommentManager();
    $comments = $commentManager->showComments($_GET['id']);
    $reportedComment = $commentManager->reportPending($_GET['id']);
    
    require('view/backend/adminView.php');
}

function editChapterView()
{
    $postManager = new PostManager(); // Création d'un objet
    $post = $postManager->getPost($_GET['id']); // Appel d'une fonction de cet objet
    $commentManager = new CommentManager();
    $comments = $commentManager->showComments($_GET['id']);
    
    require('view/backend/editChapterView.php');
}

function addChapterView()
{   
    
    require('view/backend/addChapterView.php');
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

    var_dump($affectedLines);
     if ($affectedLines === false) {
        throw new Exception('Impossible d\'editer le chapitre ! - frontend - l.85');
    }
    else {
        header('Location: index.php');

    }
}

function moderateComment($commentId, $postId) {
    
    
    $CommentManager = new CommentManager();
    $affectedLines = $CommentManager->deleteComment($commentId);
    if ($affectedLines === false) {
        throw new Exception('Impossible de supprimer le commentaire ! - frontend - l.104');
    }
    else {
        header('Location: index.php?action=adminView&id='.$postId['id']);
    }
}

function showReportedComment($commentId, $postId) {

    $commentManager = new CommentManager();
    $comments = $commentManager->reportPending($_GET['id']);
    if ($comments->rowCount() != 0) { //test si la requete renvoie une ligne minimum
        $postManager = new PostManager(); 
        $post = $postManager->getPost($_GET['id']); 
        require('view/backend/adminComment.php');
    }
    else{
        echo "pas de commentaire à modérer"; 
        header('Location: index.php?action=adminView&id='.$postId['id']);
    } 
}
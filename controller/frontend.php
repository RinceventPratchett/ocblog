<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');


function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->showChapters(); // Appel d'une fonction de cet objet

    require('view/frontend/indexView.php');
}

function postDetails()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->showComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->newComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

//function adminView()
//{
//    $postManager = new PostManager(); // Création d'un objet
//    $post = $postManager->getPost($_GET['id']); // Appel d'une fonction de cet objet
//    $commentManager = new CommentManager();
//    $comments = $commentManager->showComments($_GET['id']);
//    $reportedComment = $commentManager->reportPending($_GET['id']);
//    
//    require('view/frontend/adminView.php');
//}
//
//function editChapterView()
//{
//    $postManager = new PostManager(); // Création d'un objet
//    $post = $postManager->getPost($_GET['id']); // Appel d'une fonction de cet objet
//    $commentManager = new CommentManager();
//    $comments = $commentManager->showComments($_GET['id']);
//    
//    require('view/frontend/editChapterView.php');
//}
//
//function addChapterView()
//{   
//    
//    require('view/frontend/addChapterView.php');
//}
//
//function addChapter($chapterTitle, $chapterContent)
//{
//    $PostManager = new PostManager();
//    $affectedLines = $PostManager->newChapter($chapterTitle, $chapterContent);
//     if ($affectedLines === false) {
//        throw new Exception('Impossible d\'ajouter le chapitre !');
//    }
//    else {
//        header('Location: index.php');
//
//    }
//}
//
//function editChapter($chapterTitle, $chapterContent, $chapterId)
//{
//    $PostManager = new PostManager();
//    
//    $affectedLines = $PostManager->updateChapter($chapterTitle, $chapterContent, $chapterId);
//
//    var_dump($affectedLines);
//     if ($affectedLines === false) {
//        throw new Exception('Impossible d\'editer le chapitre ! - frontend - l.85');
//    }
//    else {
//        header('Location: index.php');
//
//    }
//}
//
//function moderateComment($commentId, $postId) {
//    
//    
//    $CommentManager = new CommentManager();
//    $affectedLines = $CommentManager->deleteComment($commentId);
//    if ($affectedLines === false) {
//        throw new Exception('Impossible de supprimer le commentaire ! - frontend - l.104');
//    }
//    else {
//        header('Location: index.php?action=adminView&id='.$postId['id']);
//    }
//}

function reportComment($commentId) {
    
    $CommentManager = new CommentManager();
    $affectedLines = $CommentManager->reportComment($commentId);
    var_dump($affectedLines);
    if ($affectedLines === false) {
        throw new Exception('Impossible de signaler le commentaire (reportedComment->frontend)');
    }
    else {
        header('Location: /view/frontend/confirmationReport.php');
    }
}

//function showReportedComment($commentId, $postId) {
//
//    $commentManager = new CommentManager();
//    $comments = $commentManager->reportPending($_GET['id']);
//    if ($comments->rowCount() != 0) { //test si la requete renvoie une ligne minimum
//        $postManager = new PostManager(); 
//        $post = $postManager->getPost($_GET['id']); 
//        require('view/frontend/adminComment.php');
//    }
//    else{
//        echo "pas de commentaire à modérer"; 
//        header('Location: index.php?action=adminView&id='.$postId['id']);
//    } 
//}
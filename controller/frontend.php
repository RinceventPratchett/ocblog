<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function adminView()
{
    $postManager = new PostManager(); // Création d'un objet
    $post = $postManager->getPost($_GET['id']); // Appel d'une fonction de cet objet
    $commentManager = new CommentManager();
    $comments = $commentManager->showComments($_GET['id']);
    
    require('view/frontend/adminView.php');
}

function editChapterView()
{
    $postManager = new PostManager(); // Création d'un objet
    $post = $postManager->getPost($_GET['id']); // Appel d'une fonction de cet objet
    $commentManager = new CommentManager();
    $comments = $commentManager->showComments($_GET['id']);
    
    require('view/frontend/editChapterView.php');
}
function addChapterView()
{
        
    require('view/frontend/addChapterView.php');
}

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

function moderateComment($commentId) {
    
    $CommentManager = new CommentManager();
    $affectedLines = $CommentManager->deleteComment($commentId);
    if ($affectedLines === false) {
        throw new Exception('Impossible de supprimer le commentaire ! - frontend - l.104');
    }
    else {
        header('Location: index.php');

    }
}
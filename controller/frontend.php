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


function reportComment($commentId) {
    
    $CommentManager = new CommentManager();
    $affectedLines = $CommentManager->reportComment($commentId);
    if ($affectedLines === false) {
        throw new Exception('Impossible de signaler le commentaire (reportComment->frontend)');
    }
    else {
        header('Location: /view/frontend/confirmationReport.php');
    }
}

<?php

// Chargement des classes
require_once(MODEL_DIR.'/PostManager.php');
require_once(MODEL_DIR.'/CommentManager.php');
require_once(MODEL_DIR.'/AdminManager.php');


function login(){
    require(FRONT_VIEW_DIR.'/loginView.php');
}

function signIn(){
    $AdminManager = new AdminManager();
    $signIn = $AdminManager->signIn();
    if ($signIn){
       header('Location: index.php');
    }
    throw new Exception('Impossible de se connecter !');
}

function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->showChapters(); // Appel d'une fonction de cet objet

    require(FRONT_VIEW_DIR.'/indexView.php');
}

function postDetails()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->showComments($_GET['id']);

    require(FRONT_VIEW_DIR.'/postView.php');
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

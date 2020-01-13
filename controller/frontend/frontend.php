<?php

// class loading
require_once(MODEL_DIR.'/PostManager.php');
require_once(MODEL_DIR.'/CommentManager.php');
require_once(MODEL_DIR.'/AdminManager.php');
require_once(MODEL_DIR.'/Pagination.php');



function login(){  //page containing the connexion form
    require(FRONT_VIEW_DIR.'/loginView.php');
}

function signIn(){ 
    $AdminManager = new AdminManager();
    $signIn = $AdminManager->signIn();
    if ($signIn){
       header('Location: index.php');
    }
    throw new Exception('Impossible de se connecter !');
    echo '<a class="btn btn-info linkAdmin" href="index.php">Retour à la liste des billets</a>';
}

function signOut(){
    $AdminManager = new AdminManager();
    $signOut = $AdminManager->signOut();
    
    header('Location: index.php');
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
	
    $posts = $postManager->showChapters($cPage, $postsPerPage);

    
    require(FRONT_VIEW_DIR.'/indexView.php');
}

function postDetails() //Show one chapter and existing comments depending of
{
    $postManager = new PostManager();
    $post = $postManager->getPost($_GET['id']);
    $commentManager = new CommentManager();
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
        header('Location: index.php?action=showPost&id=' . $postId);
    }
}


function reportComment($commentId, $chapterId) {
    
   
    $CommentManager = new CommentManager();
    $affectedLines = $CommentManager->reportComment($commentId, $chapterId);
    
    if ($affectedLines === false) {
        throw new Exception('Impossible de signaler le commentaire (reportComment->frontend)');
    }
    else {
 //       var_dump($post->errorInfo(), $post->rowCount()); //pour afficher les erreurs sql
        header('Location: index.php?action=showPost&id='.$chapterId);       
    }
}
    
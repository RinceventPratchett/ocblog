<?php

session_start();

//check si session admin est ouverte

if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']){
    require(CONTROLLER_DIR.'/backend/backend.php');
}

try{
    
    if (isset($_GET['action'])) {
        
        
        //action du backend        
        if(($_GET['action'] == 'adminView' || $_GET['action'] == 'addChapterView' || 
                $_GET['action'] == 'editChapterView' || $_GET['action'] == 'showReportedComment' || 
                $_GET['action'] == 'addChapter' || $_GET['action'] == 'editChapter' || 
                $_GET['action'] == 'moderateComment' || $_GET['action'] == 'showAllReportedComment' || $_GET['action'] == 'removeChapter' ) && $_SESSION['adminLogged'] == true){
            
            if ($_GET['action'] == 'adminView') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    adminView();
                }
            }
            elseif ($_GET['action'] == 'addChapterView') {
                    addChapterView();
            }
            elseif ($_GET['action'] == 'editChapterView') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    editChapterView();
                }
            }
            elseif ($_GET['action'] == 'showReportedComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    showReportedComment($_GET['id'], $_GET['id']);
                }
                else {
                    throw new Exception('Aucun id de chapitre envoyé');
                }
            }
            elseif ($_GET['action'] == 'showAllReportedComment') {
                showAllReportedComment('$commentId');
            }
            elseif ($_GET['action'] == 'addChapter') {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    addChapter($_POST['title'], $_POST['content']);
                }
                else {
                    throw new Exception('un des champs requis est manquant  (addChapter)');
                }
            }
            elseif ($_GET['action'] == 'editChapter') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['title']) && !empty($_POST['content'])) {
                        editChapter($_POST['title'], $_POST['content'], $_GET['id']);
                    }
                    else
                    {
                        throw new Exception('un de champs est reconnu comme vide - controler - editChapter - l55');
                    }    
                }    
                else {
                    throw new Exception('pas d\'id de chapitre retourné (controler editChapter)');
                }
            }
            elseif ($_GET['action'] == 'moderateComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['postId']) && $_GET['postId'] > 0) {
                    moderateComment($_GET['id'],$_GET['postId']);
                }
                else {

                    throw new Exception('impossible de supprimer le commentaire --> index.php');
                }
            }
            elseif ($_GET['action'] == 'removeChapter') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    removeChapter($_GET['id']);
                }
                else {

                    throw new Exception('impossible de supprimer le chapitre --> index.php');
                }
            }
        }
        
        
        //action du frontend                 
        else {   
            
            require(CONTROLLER_DIR.'/frontend/frontend.php');
            
            if ($_GET['action'] == 'listPosts') {
                listPosts();
            }
            elseif ($_GET['action'] == 'login') {
                login();
            }
             elseif ($_GET['action'] == 'signOut') {
                if ($_SESSION['adminLogged']){
                    signOut();
                }
             }    
            elseif ($_GET['action'] == 'signIn') {
                signIn();
            }
            elseif ($_GET['action'] == 'reportComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['postId']) && $_GET['postId'] > 0) {
                    reportComment($_GET['id'], $_GET['postId']);
                }
            }
            elseif ($_GET['action'] == 'showPost') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    postDetails();
                }
                else {
                    throw new Exception('Aucun id de chapitre envoyé');
                }
            }
            elseif ($_GET['action'] == 'addComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                        addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                    }
                    else {
                        throw new Exception('Tous les champs ne sont pas remplis');
                    }
                }
                else {
                    throw new Exception('Aucun identifiant de chapitre envoyé (addComment)');
                }
            }
            else {
                listPosts(); //si aucune action front, on affiche l'index du site
            }
        }
    }
    else {
        require(CONTROLLER_DIR.'/frontend/frontend.php');
        listPosts();
    }
} 
catch (Exception $e) {
    echo 'Erreur : ' .$e->getMessage(); //si erreur on recupere le message cfg dans les differents files
}

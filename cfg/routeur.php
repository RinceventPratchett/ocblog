<?php

session_start();

require(CONFIG_DIR . '/helpers.php');

if (IsAdminLogedIn()){//control if admin session is already open
    require(CONTROLLER_DIR . '/backend/backend.php');
}

require(CONTROLLER_DIR . '/frontend/frontend.php');




try {
    if (isset($_GET['action'])) {

        //backend features with admin logged compulsory   
        if (($_GET['action'] == 'adminView' || $_GET['action'] == 'addChapterView' ||
                $_GET['action'] == 'editChapterView' || $_GET['action'] == 'showReportedComment' ||
                $_GET['action'] == 'addChapter' || $_GET['action'] == 'editChapter' ||
                $_GET['action'] == 'moderateComment' || $_GET['action'] == 'showAllReportedComment' || $_GET['action'] == 'removeChapter' ) && $_SESSION['adminLogged'] == true) {

            if ($_GET['action'] == 'adminView') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    (new BackendController)->adminView();
                    }
                    
            } elseif ($_GET['action'] == 'addChapterView') {
                    (new BackendController)->addChapterView();
                } elseif ($_GET['action'] == 'editChapterView') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        (new BackendController)->editChapterView();
                }
                
            } elseif ($_GET['action'] == 'showReportedComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    (new BackendController)->showReportedComment($_GET['id'], $_GET['id']);
                } else {
                    throw new Exception('Aucun id de chapitre envoyé');
                }
                
            } elseif ($_GET['action'] == 'showAllReportedComment') {
               (new BackendController)->showAllReportedComment('$commentId');
                
            } elseif ($_GET['action'] == 'addChapter') {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    (new BackendController)->addChapter($_POST['title'], $_POST['content']);
                } else {
                    throw new Exception('un des champs requis est manquant');
                }
                
            } elseif ($_GET['action'] == 'editChapter') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['title']) && !empty($_POST['content'])) {
                        (new BackendController)->editChapter($_POST['title'], $_POST['content'], $_GET['id']);
                    } else {
                        throw new Exception('un de champs est reconnu comme vide');
                    }
                } else {
                    throw new Exception('pas d\'id de chapitre retourné');
                }
                
            } elseif ($_GET['action'] == 'moderateComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['postId']) && $_GET['postId'] > 0) {
                    (new BackendController)->moderateComment($_GET['id'], $_GET['postId']);
                } else {

                    throw new Exception('impossible de supprimer le commentaire');
                }
                
            } elseif ($_GET['action'] == 'removeChapter') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    (new BackendController)->removeChapter($_GET['id']);
                } else {
                    throw new Exception('impossible de supprimer le chapitre');
                }
            }
        }


        //frontend features
        else {


            if ($_GET['action'] == 'listPosts') {
                (new FrontEndController)->listPosts();
                
            } elseif ($_GET['action'] == 'login') { //page containing the sign-in form
                (new FrontEndController)->login();
                
            } elseif ($_GET['action'] == 'signOut') {
                if ($_SESSION['adminLogged']) {
                    (new FrontEndController)->signOut();
                }
                
            } elseif ($_GET['action'] == 'signIn') {
                if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                    (new FrontEndController)->signIn();
                }
                
            } elseif ($_GET['action'] == 'reportComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['postId']) && $_GET['postId'] > 0) {
                    (new FrontEndController)->reportComment($_GET['id'], $_GET['postId']);
                }
                
            } elseif ($_GET['action'] == 'showPost') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    (new FrontEndController)->postDetails();
                } else {
                    throw new Exception('Aucun id de chapitre envoyé');
                }
                
            } elseif ($_GET['action'] == 'addComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                        (new FrontEndController)->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                    } else {
                        throw new Exception('Tous les champs ne sont pas remplis');
                    }
                } else {
                    throw new Exception('Aucun identifiant de chapitre envoyé (addComment)');
                }
                
            } else {
                (new FrontEndController)->listPosts(); //si aucune action front, on affiche l'index du site
            }
        }
        
    } else {
        (new FrontEndController)->listPosts();
    }
    
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage(); //si erreur on recupere le message cfg dans les differents files
}

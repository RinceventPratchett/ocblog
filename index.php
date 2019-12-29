<?php
require('controller/frontend.php');

try{
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'adminView') {
                adminView();
                
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                postDetails();
            }
            else {
                //echo 'Erreur : aucun identifiant de billet envoyé';
                //on renvoie une exception et saute directement au catch
                throw new Exception('Aucun id de chapitre envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    //echo 'Erreur : tous les champs ne sont pas remplis !';
                    throw new Exception('Tous les champs ne sont pas remplis');
                }
            }
            else {
                //echo 'Erreur : aucun identifiant de billet envoyé';
                throw new Exception('Aucun identifiant de chapitre envoyé (addComment)');
            }
        }
        elseif ($_GET['action'] == 'addChapter') {
            //if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    addChapter($_POST['title'], $_POST['content']);
                }
            //}
            else {
                //echo 'Erreur : aucun identifiant de billet envoyé';
                throw new Exception('un des champs requis est manquant ! (addChapter)');
            }
        }
    }
    else {
        listPosts();
    }
} 
catch (Exception $e) {
    echo 'Erreur : ' .$e->getMessage(); //si erreur on recupere le message cfg dans les differents files
}
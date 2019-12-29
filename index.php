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
        elseif ($_GET['action'] == 'editChapterView') {
                editChapterView();
        }
        elseif ($_GET['action'] == 'post') {
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
        elseif ($_GET['action'] == 'addChapter') {
            if (!empty($_POST['title']) && !empty($_POST['content'])) {
                addChapter($_POST['title'], $_POST['content']);
            }
            else {
                throw new Exception('un des champs requis est manquant  (addChapter)');
            }
        }
        elseif ($_GET['action'] == 'editChapter') {
            if (!empty($_POST['title']) && !empty($_POST['content'])) {
                editChapter($_POST['title'], $_POST['content']);
            }
            else {
                throw new Exception('un des champs requis est manquant  (editChapter)');
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
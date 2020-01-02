<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ // On démarre la session AVANT d'écrire du code HTML
session_start();

// On s'amuse à créer quelques variables de session dans $_SESSION
$_SESSION['firstName'] = 'admin';
$_SESSION['lastName'] = 'admin';
$_SESSION['password'] = 'adminBlogAlaska!';


require('controller/frontend.php');
require('controller/backend.php');

try{
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'adminView') {
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
        elseif ($_GET['action'] == 'reportComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                reportComment($_GET['id']);
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
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                moderateComment($_GET['id'],$_GET['id']);
            }
            else {

                throw new Exception('impossible de supprimer le commentaire --> index.php');
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
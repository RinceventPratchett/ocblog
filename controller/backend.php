<?php

require_once('model/AdminManager.php');

function adminView()
{
    $adminManager = new AdminManager(); // Création d'un objet
    $newPost = $adminManager->newPosts(); // Appel d'une fonction de cet objet

    require('view/backend/adminView.php');
}
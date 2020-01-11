
<?php 
$title= 'connexion'; 
?>


<?php ob_start(); ?>

<em><a href="index.php" class="loginView">Retour à la liste des billets</a></em>

<article class="container login">
    <div class="col">
        <h2>IDENTIFICATION</h2>
        <form action="index.php?action=signIn" method="post">
            Veuillez entrer vos identifiants pour vous connecter:<br />
            <div>
                <label for="pseudo" class="loginView">Nom d'utilisateur</label><input type="text" name="pseudo" /><br />
                <label for="password" class="loginView">Mot de passe</label><input type="password" name="password" /><br />
                <input class="btn btn-secondary" type="submit" value="Connection" />
            </div>
        </form>
    </div>
</article>


<?php $content = ob_get_clean(); ?>

<?php require(FRONT_VIEW_DIR.'/template.php'); ?>

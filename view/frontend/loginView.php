
<?php 
$title= 'connection'; 
?>
<em><a href="index.php" class="linkAdmin">Retour à la liste des billets</a></em>


<?php ob_start(); ?>

<h2>IDENTIFICATION</h2>

<div class="container">
    <div class="col">
        <form action="index.php?action=signIn" method="post">
            Veuillez entrer vos identifiants pour vous connecter:<br />
            <div>
                <label for="pseudo">Nom d'utilisateur</label><input type="text" name="pseudo" /><br />
                <label for="password">Mot de passe</label><input type="password" name="password" /><br />
                <input class="btn btn-secondary" type="submit" value="Connection" />
            </div>
        </form>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require(FRONT_VIEW_DIR.'/template.php'); ?>

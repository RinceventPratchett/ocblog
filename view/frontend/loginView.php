
<?php $title= 'connection'; ?>


<?php ob_start(); ?>

<a class="btn btn-info loginView" href="index.php" class="loginView">Retour à la liste des billets</a>

<article class="container login">
    <div class="col">
        <h2>IDENTIFICATION</h2>
        <form class="form-group" action="index.php?action=signIn" method="POST">
            Veuillez entrer vos identifiants pour vous connecter:<br />

                <label for="pseudo">Nom d'utilisateur</label>
                <input class="form-control loginView" type="text" name="pseudo" /><br />
                
                <label for="password" >Mot de passe</label>
                <input class="form-control loginView" type="password" name="password" /><br />
                
                <input class="btn btn-secondary loginView" type="submit" value="Connection" />

        </form>
    </div>
</article>


<?php $content = ob_get_clean();
require(FRONT_VIEW_DIR.'/template.php');

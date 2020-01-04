
<?php 
$title= 'Espace admin'; 
?>

<div class="content">
    <form action="index.php?action=signIn" method="post">
        Veuillez entrer vos identifiants pour vous connecter:<br />
        <div class="center">
            <label for="pseudo">Nom d'utilisateur</label><input type="text" name="pseudo" /><br />
            <label for="password">Mot de passe</label><input type="password" name="password" /><br />
            <input type="submit" value="Connection" />
                </div>
    </form>
</div>
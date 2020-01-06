<!DOCTYPE html>
<!--
developed by Voy
-->


<html lang="fr">
    <head>
        <title><?= $title ?></title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1.0">
        <link href="public/css/style.css" rel="stylesheet" /> 
        <script src="https://kit.fontawesome.com/3b3ab33fc7.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
        
    <body>
        <header>
            <h1>Billet simple pour l'Alaska</h1>;            
        </header>
        
        <?php
            if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']) {
        
            }else{
        ?>
            <form action="index.php?action=login" method="post" class="signInBtn">
                <input class="btn btn-secondary specific" type="submit" value="sign-in" />
            </form>
        <?php
            }
        ?>
        <?= $content ?>
        <footer>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </footer>
    </body>
</html>


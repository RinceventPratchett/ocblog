<!DOCTYPE html>


<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Billet simple pour l'Alaska</title>
        <link href="public/css/style.css" rel="stylesheet" /> 
        <script src="https://kit.fontawesome.com/3b3ab33fc7.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://cdn.tiny.cloud/1/s7z0p4uql3il9souj198c05m21nigwpt2id8e5e6oymvr5n5/tinymce/5/tinymce.min.js"></script> 
        <script>
            tinymce.init({
                selector: '.default'
            });
        </script>
    </head>
        
    <body>
        <header>
            <?php
                if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']) {
            ?>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <span class="navbar-brand" href="#">Administration</span>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link active" href="/index.php">Retour à la liste des billets</a>
                            <a class="nav-item nav-link" href="index.php?action=addChapterView">Ajouter un chapitre</a>
                            <a class="nav-item nav-link" href="index.php?action=showAllReportedComment">administrer les commentaires reported</a>
                            <form action="index.php?action=signOut" method="post" class="signInBtn">
                                <input class="btn btn-secondary specific back" type="submit" value="sign-out" />
                            </form> 
                        </div>
                    </div>
                </nav>
            <?php
                }
            ?>
        </header>
        
        <section class='back'>
            <?= $content ?>
        </section>
        
        <footer>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </footer>
    </body>
</html>


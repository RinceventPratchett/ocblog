<?php
    if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']) {
?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="#">Features</a>
                    <a class="nav-item nav-link" href="#">Pricing</a>
                    <a class="nav-item nav-link disabled" href="#">Disabled</a>
                </div>
            </div>
        </nav>
<?php
    }
?>

<div class="container">
    <div class="row">


        <?php
        $title = 'Billet simple pour l\'Alaska';
        ?>

        <?php
        ob_start();
        ?>
        
        <h1>Blog Alaska !</h1>
        <form action="index.php?action=login" method="post" class="signInBtn">
            <input type="submit" value="sign-in" />
        </form>
        <?php
            if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']) {
        ?>    
                <form action="index.php?action=signOut" method="post" class="signInBtn">
                    <input type="submit" value="sign-out" />
                </form>
        <?php
            }
        ?>
        <h2>Derniers billets du blog :</h2>

        <?php
        while ($data = $posts->fetch()) {
            ?>


            <div class="news col">
                <h3>
                    <?= htmlspecialchars($data['title']) ?>
                    <em>le <?= $data['creation_date_fr'] ?></em>
                </h3>

                <p>
                    <?= nl2br($data['content']) ?>
                    <br />
                </p>
                <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em> <br />
                <?php
                if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']) {
                    ?>
                    <em><a href="index.php?action=adminView&amp;id=<?= $data['id'] ?>">administration</a></em> <br />
                    <?php
                }
                ?>


            </div>

            <?php
        }
        $posts->closeCursor();
        ?>
        <?php $content = ob_get_clean(); ?>
    </div>
</div>
<?php require(FRONT_VIEW_DIR.'/template.php'); ?>
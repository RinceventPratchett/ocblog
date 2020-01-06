<div class="container">
    <div class="row">


        <?php
        ob_start();
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
                </p>
                <em><a href="index.php?action=showPost&amp;id=<?= $data['id'] ?>">Commentaires</a></em><br />
                <?php
                if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']) {
                    ?>
                    <em><a href="index.php?action=adminView&amp;id=<?= $data['id'] ?>">administration du chapitre</a></em>
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

<?php
    if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']) {
        require(BACK_VIEW_DIR . '/template.php');
    }
 else {
        require(FRONT_VIEW_DIR . '/template.php');
    }
?>
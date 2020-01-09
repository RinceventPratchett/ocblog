        <?php
        ob_start();
        
        if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']) {
        ?>
            <h1>Espace administration</h1> 
        <?php
        }
        ?>        
        <h2>Derniers billets du blog :</h2>

        <?php
        while ($data = $posts->fetch()) {
            ?>
            <article class="news col">
                <h3>
                    <?= ($data['title']) ?>
                    <em>le <?= $data['creation_date_fr'] ?></em>
                </h3>

                <div>
                    <?= nl2br($data['content']) ?>
                </div>
                <em><a href="index.php?action=showPost&amp;id=<?= $data['id'] ?>">Commentaires</a></em><br />
                <?php
                if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']) {
                    ?>
                    <em><a href="index.php?action=adminView&amp;id=<?= $data['id'] ?>">administration du chapitre</a></em>
                    <?php
                }
                ?>
            </article>

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
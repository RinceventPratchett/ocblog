<?php
ob_start();
?>  

<div class="backgroundIndex"></div>

<div class='intro'>
    <p>Bienvenue sur le blog de Jean Forteroche</p>

    <p>
        Je vous propose de suivre mon dernier Roman semaine après semaine.<br />
        En effet, tous les dimanches un nouveau billet sera posté et vous pourrez réagir 
        directement sous chacun d'eux.

    </p>
</div>


<h2 class="indexView">Derniers billets du blog :</h2>

<div class="chapter">
    <?php
    while ($data = $posts->fetch()) {
        ?>
        <article class="news col-3 indexView">
            <h3>
                <?= ($data['title']) ?>
            </h3>

            <div>
                <em>le <?= $data['creation_date_fr'] ?></em>
                <?php
                $extract = substr($data['content'], 0, 500);
                echo $extract . " ...";
                ?>

            </div>
            
            <div>
                <a class="btn btn-info" href="index.php?action=showPost&amp;id=<?= $data['id'] ?>">Visualiser le chapitre et/ou laisser un commentaire</a>

                <?php
                if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']) {
                    ?>

                    <a class="btn btn-dark" href="index.php?action=adminView&amp;id=<?= $data['id'] ?>">administration du chapitre</a>

                    <?php
                }
                ?>
            </div>
        </article>
        <?php
    }
    $posts->closeCursor();
    ?>    
</div>
<?php
if ($nbPage >= 2) {
    ?>
    <div class="pagin">
        <?php
        for ($i = 1; $i <= $nbPage; $i++) {
            if ((!isset($_GET['page']) && $i == 1) || (isset($_GET['page']) && $_GET['page'] == $i)) {
                echo "<span class='cPageFrame'>$i</span>";
            } else {
                echo "<a class='pageBlock' href=\"index.php?page=$i\">$i</a>";
            }
        }
    }
    ?>


    </div>

<?php $content = ob_get_clean(); ?>

<?php
if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']) {
    require(BACK_VIEW_DIR . '/template.php');
} else {
    require(FRONT_VIEW_DIR . '/template.php');
}

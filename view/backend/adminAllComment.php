<?php $title = "Visualisation des commentaires signalés"; ?>

<?php ob_start(); ?>
<h1>Visualisation des commentaires signalés</h1>


<h2 class="titleAdminComReported">Commentaires</h2>

<div class="container adminComReported">

    <?php foreach ($comments as $comment) { ?>


    <article  class="row comment adminComReported">
        <div class="col">
            <strong>chapter n° <?= $comment['id_chapter'] ?></strong><br />
            <strong><?= ($comment['author']) ?></strong><br />
            le <em><?= $comment['comment_date_fr'] ?></em><br />
            <?= nl2br($comment['comment']) ?><br />
            commentaire signalé <strong><?= nl2br($comment['reported']) ?></strong> fois<br />
            
            <div>
                <form action="index.php?action=moderateComment&amp;id=<?= $comment['id'] ?>&postId=<?= $comment['id_chapter'] ?>" onsubmit="return confirm('Voulez vous supprimer le commentaire ?')" method="POST">
                    <input class="btn btn-danger" type="submit" value="supprimer le commentaire" />
                </form>
                <a href="index.php?action=adminView&id=<?= $comment['id_chapter'] ?>" class="btn btn-info">rejoindre le chapitre</a><br />
            </div>
        </div>
    </article>
    <?php } ?>
</div>

<?php $content = ob_get_clean();
require(BACK_VIEW_DIR.'/template.php');

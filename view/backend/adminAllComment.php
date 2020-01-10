<?php $title = "Visualisation des commentaires reported"; ?>

<?php ob_start(); ?>
<h1>Visualisation des commentaires reported</h1>


<h2 class="titleAdminComReported">Commentaires</h2>

<div class="container adminComReported">
    <?php

    while ($comment = $comments->fetch())

    {
    ?>

    <article  class="row comment adminComReported">
        <div class="col">
            <strong>chapter n° <?= $comment['id_chapter'] ?></strong><br />
            <strong><?= htmlspecialchars($comment['author']) ?></strong><br />
            le <?= $comment['comment_date_fr'] ?><br />
            <?= nl2br(htmlspecialchars($comment['comment'])) ?><br />
            commentaire signalé <strong><?= nl2br(htmlspecialchars($comment['reported'])) ?></strong> fois<br />
            <form action="index.php?action=moderateComment&amp;id=<?= $comment['id'] ?>&postId=<?= $comment['id_chapter'] ?>" method="POST">
                <input class="btn btn-secondary" type="submit" value="supprimer commentaire" />
            </form><br />
            <em><a href="index.php?action=showPost&amp;id=<?= $comment['id_chapter'] ?>" class="btn btn-secondary">rejoindre le chapitre</a></em><br />
        </div>
    </article>
    <?php
    }
    ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require(BACK_VIEW_DIR.'/template.php'); ?>

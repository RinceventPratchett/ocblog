<?php $title = "Visualisation des commentaires signalés"; ?>

<?php ob_start(); ?>
<h1>Visualisation des commentaires signalés du chapitre n°<?= $post['id'] ?></h1>


<a class="btn btn-info linkAdmin adminCommentReportedByChapter" href="index.php?action=adminView&amp;id=<?= $post['id'] ?>">retour administration du billet</a><br />

<div class="adminCommentReportedByChapter">
    <h2 class="adminCommentReportedByChapter">Commentaires</h2>

    <?php
    while ($comment = $comments->fetch())
    {
    ?>
        <article class="comment adminCommentReportedByChapter">
            <strong><?= htmlspecialchars($comment['author']) ?></strong><br />
            le <?= $comment['comment_date_fr'] ?><br />
            <?= nl2br(htmlspecialchars($comment['comment'])) ?><br />

            commentaire signalé <strong><?= nl2br(htmlspecialchars($comment['reported'])) ?></strong> fois<br />
            <form action="index.php?action=moderateComment&amp;id=<?= $comment['id'] ?>&postId=<?= $post['id'] ?>" onsubmit="return confirm('Voulez vous supprimer le commentaire ?')" method="POST" class='deletecom'>
                <input class="btn btn-danger" type="submit" value="supprimer commentaire" />
            </form>        
        </article>
    <?php
    }
    ?>
</div>

<?php $content = ob_get_clean();
require(BACK_VIEW_DIR.'/template.php');

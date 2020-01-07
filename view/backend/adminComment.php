<?php $title = "Visualisation des commentaires reported"; ?>

<?php ob_start(); ?>
<h1>Visualisation des commentaires reported</h1>

<div class="linkAdmin">
    <em><a href="index.php?action=adminView&amp;id=<?= $post['id'] ?>">retour administration du billet</a></em><br />
</div>


<h2>Commentaires</h2>

<?php
while ($comment = $comments->fetch())
{
?>
    <article class="comment">
        <strong><?= htmlspecialchars($comment['author']) ?></strong><br />
        le <?= $comment['comment_date_fr'] ?><br />
        <?= nl2br(htmlspecialchars($comment['comment'])) ?><br />
        commentaire signalé <strong><?= nl2br(htmlspecialchars($comment['reported'])) ?></strong> fois<br />
        <form action="index.php?action=moderateComment&amp;id=<?= $comment['id'] ?>" method="post" class='deletecom'>
            <input class="btn btn-secondary" type="submit" value="supprimer commentaire" />
        </form>        
    </article>
<?php
}
?>

<?php $content = ob_get_clean(); ?>

<?php require(BACK_VIEW_DIR.'/template.php'); ?>

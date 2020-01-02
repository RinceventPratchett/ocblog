<?php $title = "Visualisation des commentaires reported"; ?>

<?php ob_start(); ?>
<h1>Visualisation des commentaires reported</h1>

<em><a href="index.php?action=adminView&amp;id=<?= $post['id'] ?>">retour administration du billet</a></em><br />
<em><a href="/index.php">Retour à la liste des billets</a></em>



<h2>Commentaires</h2>

<?php
while ($comment = $comments->fetch())
{
?>
<div class="comment">
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <p>commentaire <strong><?= nl2br(htmlspecialchars($comment['reported'])) ?></strong> fois signalé</p>
        <form action="index.php?action=moderateComment&amp;id=<?= $comment['id'] ?>" method="post">
            <input type="submit" value="supprimer commentaire" />
        </form>        
    </div>
<?php
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>


<?php $title = "interface admin"; ?>

<?php ob_start(); ?>

<h1>interface admin - modification du chapitre</h1>
<p><a href="/index.php">Retour à la liste des billets</a></p><br />
<em><a href="index.php?action=addChapterView">ajouter un chapitre</a></em><br />
<a href="index.php?action=editChapterView&amp;id=<?= $post['id'] ?>">Editer le chapitre</a>

<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>
    
    <p>
        <?= nl2br ($post['content']) ?>
    </p>
   
</div>

<h2>Commentaires</h2>

<?php
while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <form action="index.php?action=moderateComment&amp;id=<?= $comment['id'] ?>" method="post">
        <input type="submit" value="supprimer commentaire" />
    </form>

<?php
}
?>
<?php $content = ob_get_clean(); ?>


<?php require('template.php'); ?><!--attendre le chargement des données avant l'appel à template-->
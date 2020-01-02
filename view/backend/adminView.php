
<?php $title = "interface admin"; ?>

<?php ob_start(); ?>

<h1>interface admin - modification du chapitre</h1>
<em><a href="/index.php">Retour à la liste des billets</a></em><br />
<em><a href="index.php?action=addChapterView">ajouter un chapitre</a></em><br />
<em><a href="index.php?action=editChapterView&amp;id=<?= $post['id'] ?>">Editer le chapitre</a><br /></em>
<em><a href="index.php?action=showReportedComment&amp;id=<?= $post['id'] ?>">administrer les commentaires reported</a></em>

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
    

<?php
}
?>
<?php $content = ob_get_clean(); ?>


<?php require('view/frontend/template.php'); ?><!--attendre le chargement des données avant l'appel à template-->
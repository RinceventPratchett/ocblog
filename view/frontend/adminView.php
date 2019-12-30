
<?php $title = "interface admin"; ?>

<?php ob_start(); ?>
<h1>interface admin - Ajout de chapitre</h1>
<p><a href="/index.php">Retour à la liste des billets</a></p>

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
   

<a href="index.php?action=editChapterView&amp;id=<?= $post['id'] ?>">Editer le chapitre</a>
<form action="index.php?action=addChapter" method="post">
    <div>
        
        <p>Ajouter un chapitre</p>
        <label for="title">Titre</label><br />
        <input type="text" id="title" name="title" />
    </div>
    <div>
        <label for="content">Contenu</label><br />
        <input type="text" id="content" name="content" />
    </div>
    <div>
        <input type="submit" />
    </div>
</form>


<?php $content = ob_get_clean(); ?>


<?php require('template.php'); ?><!--attendre le chargement des données avant l'appel à template-->
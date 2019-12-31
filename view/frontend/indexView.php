<?php 
$title= 'Billet simple pour l\'Alaska'; 
?>

<?php 
ob_start(); 
?>

<h1>Blog Alaska !</h1>
<button type="button"><i class="fas fa-sign-in-alt fa-lg"> sign-in</i></button>
<p>Derniers billets du blog :</p>

<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= nl2br($data['content']) ?>
            <br />
        </p>
        <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em> <br />
        <em><a href="index.php?action=adminView&amp;id=<?= $data['id'] ?>">administration</a></em> <br />
        
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
<?php 
$title= 'Billet simple pour l\'Alaska'; 
?>

<?php 
ob_start(); 
?>

<h1>Blog Alaska !</h1>
<form action="index.php?action=login" method="post">
    <input type="submit" value="sign-in" />
</form>
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
        <?php 
        if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged'])
        { ?>
            <em><a href="index.php?action=adminView&amp;id=<?= $data['id'] ?>">administration</a></em> <br />
        <?php
        }
        ?>
        
        
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
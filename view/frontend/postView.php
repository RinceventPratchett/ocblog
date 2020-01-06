<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>

<em><a href="index.php" class="linkAdmin">Retour à la liste des billets</a></em>


<div class="news">
    <h3>
        <?= ($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>
    
    <p>
        <?= ($post['content']) ?>
    </p>
   
</div>

<h2>Commentaires</h2>

<?php
while ($comment = $comments->fetch())
{
?>
<div class="comment">
        <strong><?= htmlspecialchars($comment['author']) ?></strong>
        le <?= htmlspecialchars($comment['comment_date_fr']) ?><br />
        <?= (htmlspecialchars($comment['comment'])) ?> <br />
                
        <form action="index.php?action=reportComment&amp;id=<?= $comment['id'] ?>" method="post">
            <input type="submit" class="btn btn-danger" value="Signaler le commentaire"/>           
        </form>
    </div>
<?php
}
?>
<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post" class="addCommment">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input class="btn btn-secondary" type="submit" />
    </div>
</form>
   
<?php $content = ob_get_clean(); ?>

<?php
    if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']) {

        require(BACK_VIEW_DIR.'/template.php');
    }
    else {
        require(FRONT_VIEW_DIR.'/template.php'); 
    }
?>



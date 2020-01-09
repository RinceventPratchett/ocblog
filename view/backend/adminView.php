
<?php $title = "interface admin"; ?>

<?php ob_start(); ?>

<h1>interface admin </h1>

<div class="linkAdmin">
    <em><a href="index.php?action=editChapterView&amp;id=<?= $post['id'] ?>">Editer le chapitre</a><br /></em>
    <em><a href="index.php?action=showReportedComment&amp;id=<?= $post['id'] ?>">modérer les commentaires signalés du chapitre</a></em>
</div>

<article class="news">
    <h3>
        <?= ($post['title']) ?>
        <em>le <?= ($post['creation_date_fr']) ?></em>
    </h3>
    
    <div>
        <?= nl2br(($post['content'])) ?>
    </div>
   
    <form action="index.php?action=removeChapter&amp;id=<?= $post['id'] ?>" method="post">
        <input type="submit" class="btn btn-danger adminchapter" value="Supprimer le chapitre"/>           
    </form>

</article>


  

<h2>Commentaires</h2>
    <div class="col">
        <?php
        while ($comment = $comments->fetch())
        {
        ?>

            <strong><?= ($comment['author']) ?></strong><br />
            le <?= $comment['comment_date_fr'] ?><br />
            <?= nl2br($comment['comment']) ?><br />
            <?php
                if($comment['reported'] != 0){
            ?>
            Commentaire signalé <strong><?= $comment['reported'] ?></strong> fois <br /><!--pour afficher le nombre de report des commentaires sur la session admin-->
            <?php
                }    
            }
            ?>

    </div>
    
  
<?php $content = ob_get_clean(); ?>


<?php require(BACK_VIEW_DIR.'/template.php'); ?><!--attendre le chargement des données avant l'appel à template-->
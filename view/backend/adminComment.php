<?php $title = "Visualisation des commentaires signalés"; ?>

<?php ob_start(); ?>
<h1>Visualisation des commentaires signalés du chapitre n°<?= $post['id'] ?></h1>


<a class="btn btn-info linkAdmin adminCommentReportedByChapter" 
   href="index.php?action=adminView&amp;id=<?= $post['id'] ?>">retour administration du billet</a><br />

<div class="adminCommentReportedByChapter">
    <h2 class="adminCommentReportedByChapter">Commentaires signalés : </h2>
    
    
    <div class="adminCommentReportedByChapterDetails">
        <?php foreach ($comments as $comment) { ?>
            <article class="comment adminCommentReportedByChapter">
                <strong><?= ($comment['author']) ?></strong><br />
                le <em><?= $comment['comment_date_fr'] ?></em><br />
                <?= nl2br($comment['comment']) ?><br />

                commentaire signalé <strong><?= nl2br(($comment['reported'])) ?></strong> fois<br />
                <form action="index.php?action=moderateComment&amp;id=<?= $comment['id'] ?>&postId=<?= $post['id'] ?>" onsubmit="return confirm('Voulez vous supprimer le commentaire ?')" method="POST" class='deletecom'>
                    <input class="btn btn-danger" type="submit" value="supprimer le commentaire" />
                </form>         
            </article>

        <?php } ?>
    </div>
</div>

<?php $content = ob_get_clean();
require(BACK_VIEW_DIR.'/template.php');

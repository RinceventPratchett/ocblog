
<?php $title = "interface admin"; ?>

<?php ob_start(); ?>

    <h1>interface admin </h1>


    <article class="news col-3 postDetails">
        <h3>
            <?= ($post['title']) ?>
        </h3>

        <div>
            <em>le <?= ($post['creation_date_fr']) ?></em>
            <?= nl2br(($post['content'])) ?>
        </div>

        <form onsubmit="return confirm('Voulez vous supprimer le chapitre ?')" action="index.php?action=removeChapter&amp;id=<?= $post['id'] ?>" method="POST" >
            <input type="submit" class="btn btn-danger adminchapter" value="Supprimer le chapitre" />           
        </form>
    
    </article>  

    <div class="col commentAdminView">
        <h2 class="adminView">Commentaires</h2>

            <?php foreach ($comments as $comment) { ?>
        
                <article class="comment">
                    <h3><strong><?= ($comment['author']) ?></strong></h3>
                    le <em><?= $comment['comment_date_fr'] ?></em><br />
                    <?= $comment['comment'] ?> <br />

                </article>

                <?php if($comment['reported'] != 0){ ?>
                    <strong>Commentaire signalé <?= $comment['reported'] ?> fois </strong><br /><!--pour afficher le nombre de report des commentaires sur la session admin-->
            <?php
                }    
            }
            ?>
    </div>
  
<?php $content = ob_get_clean();
require(BACK_VIEW_DIR.'/template.php');
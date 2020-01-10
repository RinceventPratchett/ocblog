<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>

<?php
    if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']) {
        } else { 
        ?>
            <em><a href="index.php" class="linkAdmin">Retour à la liste des billets</a></em>
        <?php 
        }
        ?>
<section class="postView">
    <article class="news col-3 postDetails">
        <h3>
            <?= ($post['title']) ?>
            <em>le <?= $post['creation_date_fr'] ?></em>
        </h3>

        <div>
            <?= ($post['content']) ?>
        </div>

    </article>
    <div class="commentView">
        <h2 class="comment">Commentaires</h2>

        <?php
        while ($comment = $comments->fetch())
        {
        ?>
                <article class="comment">
                    <strong><?= ($comment['author']) ?></strong>
                    le <?= $comment['comment_date_fr'] ?><br />
                    <?= $comment['comment'] ?> <br />

                    <a href="index.php?action=reportComment&amp;id=<?= $comment['id'] ?>&postId=<?= $post['id'] ?> " class="btn btn-danger" onclick="confirmer(<?= $comment['id']?>, <?= $post['id'] ?>)">Signaler le commentaire</a>
                </article>
        <?php
        }
        ?>

        <script>
            function confirmer(commentId,postId){
                var res = alert("Commentaire signalé, merci ! " + commentId + " / " + postId) ;
                res;
            }
        </script>

        <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="POST" class="addCommment">
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
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php
    if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']) {
        require(BACK_VIEW_DIR.'/template.php');
    }
    else {
        require(FRONT_VIEW_DIR.'/template.php'); 
    }
?>



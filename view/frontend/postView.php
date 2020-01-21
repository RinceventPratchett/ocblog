<?php $title = $post['title']; ?>

<?php ob_start(); ?>

<?php if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']) {
    
         } else { ?>
            <a href="index.php" class="btn btn-info linkAdmin">Retour à la liste des billets</a>
        <?php } ?>
        
<div class="backGroundPostView"></div>
                
<div class="postView">
    
    <article class="news col-3 postDetails">
        <h3>
            <?= ($post['title']) ?>
        </h3>

        <div>
            <em>le <?= $post['creation_date_fr'] ?></em>
            <?= ($post['content']) ?>
        </div>

    </article>
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
    
    <div class="commentView">
        <h2 class="comment">Commentaires</h2>

       <?php foreach ($comments as $comment) { ?>
                <article class="comment">
                    <h3><strong><?= ($comment['author']) ?></strong></h3>
                    le <em><?= $comment['comment_date_fr'] ?></em><br />
                    <?= $comment['comment'] ?> <br />

                    <a href="index.php?action=reportComment&amp;id=<?= $comment['id'] ?>&postId=<?= $post['id'] ?> " class="btn btn-danger" onclick="confirmer(<?= $comment['id']?>, <?= $post['id'] ?>)">Signaler le commentaire</a>
                </article>
        <?php } ?>

        <script>
            function confirmer(){
                var res = alert("Commentaire signalé, merci !");
                res;
            }
        </script>
    </div>
        

</div>

<?php $content = ob_get_clean(); ?>

<?php
    if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged']) {
        require(BACK_VIEW_DIR.'/template.php');
    }
    else {
        require(FRONT_VIEW_DIR.'/template.php'); 
    }



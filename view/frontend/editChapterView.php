

<?php $title = "interface admin"; ?>

<?php ob_start(); ?>
<h1>interface admin - edition de chapitre</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>
<em><a href="index.php?action=adminView&amp;id=<?= $post['id'] ?>">retour administration du billet</a></em><br />

<p>Derniers billets du blog :</p>


    <div class="news">

        <form action="index.php?action=editChapter&amp;id=<?= $post['id'] ?>" method="post">
            <div>
                <em>le <?= $post['creation_date_fr'] ?></em>
                
                    <label for="title"><?= $post['title'] ?></label><br /> 
                    <input type="text" id="title" name="title" value="" placeholder="title to be modified" /> <br />
                        <label id="content" for="content">Contenu du chapitre</label><br />
                        <textarea type="text" class="default" name="content">
                            <?= $post['content'] ?>
                        </textarea>

                        <input type="submit" /><br />
                        <em><a href="index.php?action=post&amp;id=<?= $post['id'] ?>">Commentaires</a></em>
                
            </div>
        </form>
    </div>
            
<?php $content = ob_get_clean(); ?>


<?php require('template.php'); ?><!--attendre le chargement des données avant l'appel à template-->
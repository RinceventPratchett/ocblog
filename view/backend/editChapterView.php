

<?php $title = "interface admin"; ?>

<?php ob_start(); ?>
<h1>interface admin - edition de chapitre</h1>
<div class="linkAdmin">
    <em><a href="index.php">Retour à la liste des billets</a></em><br />
    <em><a href="index.php?action=adminView&amp;id=<?= $post['id'] ?>">retour administration du billet</a></em><br />
</div>

<h2>Derniers billets du blog :</h2>


    <article class="news col-3">

        <form action="index.php?action=editChapter&amp;id=<?= $post['id'] ?>" method="post">
            <div>
                <em>le <?= $post['creation_date_fr'] ?></em><br />
                <strong><label for="title"><?= $post['title'] ?></label></strong><br /> 
                <input type="text" id="title" name="title" value="<?= $post['title'] ?>" /> <br />
                <label id="content" for="content">Contenu du chapitre</label><br />
                <textarea type="text" class="default" name="content"><?= $post['content'] ?></textarea>

                <input class="btn btn-secondary" type="submit" /><br />
                <em><a href="index.php?action=adminView&amp;id=<?= $post['id'] ?>">Commentaires</a></em>
                
            </div>
        </form>
        <form action="index.php?action=removeChapter&amp;id=<?= $post['id'] ?>" method="post">
            <input type="submit" class="btn btn-danger adminchapter" value="Supprimer le chapitre"/>           
        </form>
    </article>
            
<?php $content = ob_get_clean(); ?>


<?php require(BACK_VIEW_DIR.'/template.php'); ?><!--attendre le chargement des données avant l'appel à template-->
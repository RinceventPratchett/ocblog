

<?php $title = "interface admin"; ?>

<?php ob_start(); ?>
    <h1>interface admin - edition de chapitre</h1>

    <a class="btn btn-info linkAdmin editChapter" href="index.php?action=adminView&amp;id=<?= $post['id'] ?>">retour administration du billet</a><br />

    <h2 class="chapterView">Derniers billets du blog :</h2>


    <article class="news col-3 edChapView">

        <form action="index.php?action=editChapter&amp;id=<?= $post['id'] ?>" method="POST">
            <div>
                <strong><label for="title"><?= $post['title'] ?></label></strong><br /> 
                <em>le <?= $post['creation_date_fr'] ?></em><br />
                <input type="text" id="title" name="title" value="<?= $post['title'] ?>" /> <br />
                <label id="content" for="content">Contenu du chapitre</label><br />
                <textarea type="text" id="default" name="content"><?= $post['content'] ?></textarea>
                
                <input class="btn btn-secondary" type="submit" /><br />
                
                <a class="btn btn-info" href="index.php?action=adminView&amp;id=<?= $post['id'] ?>">voir les commentaires</a><br />
            </div>
        </form>
        <form onsubmit="return confirm('Voulez vous supprimer le chapitre ?')" action="index.php?action=removeChapter&amp;id=<?= $post['id'] ?>" method="POST" >
            <input type="submit" class="btn btn-danger adminchapter" value="Supprimer le chapitre" />           
        </form>
        
    </article>
            
<?php $content = ob_get_clean();

require(BACK_VIEW_DIR.'/template.php');
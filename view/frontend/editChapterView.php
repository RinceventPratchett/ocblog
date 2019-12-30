
<?php $title = "interface admin"; ?>

<?php ob_start(); ?>
<h1>interface admin - edition de chapitre</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<p>Derniers billets du blog :</p>


    <div class="news">
        <script src="https://cdn.tiny.cloud/1/s7z0p4uql3il9souj198c05m21nigwpt2id8e5e6oymvr5n5/tinymce/5/tinymce.min.js"></script> 
        <script>
            tinymce.init({
                selector: '.default'
            });
        </script>
        
        <form action="index.php?action=editChapter&amp;id=<?= $post['id'] ?>" method="post">
            <div>
                <em>le <?= $post['creation_date_fr'] ?></em>

                <label for="title"><?= $post['title'] ?></label><br /> 
                <input type="text" id="title" name="title" value="" placeholder="title to be modified" /> <br />
                
                <label id="content" for="content">Contenu du chapitre</label><br />
                <textarea type="text" class="default" name="content">
                    <?= $post['content'] ?>
                </textarea>

            

                <input type="submit" />
            </form>
        </div>
                <em><a href="index.php?action=post&amp;id=<?= $post['id'] ?>">Commentaires</a></em>
    </div>



<?php $content = ob_get_clean(); ?>


<?php require('template.php'); ?><!--attendre le chargement des données avant l'appel à template-->
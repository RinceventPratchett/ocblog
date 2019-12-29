<?php $title = "interface admin"; ?>

<?php ob_start(); ?>
<h1>interface admin</h1>
<p><a href="/index.php">Retour à la liste des billets</a></p>

<p>Derniers billets du blog :</p>


<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <script src="https://cdn.tiny.cloud/1/s7z0p4uql3il9souj198c05m21nigwpt2id8e5e6oymvr5n5/tinymce/5/tinymce.min.js"></script> 
        <script>
            tinymce.init({
                selector: '.default'
            });
        </script>
        <textarea class="default">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= nl2br(htmlspecialchars($data['content'])) ?>
            <br />
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
        </p>
        </textarea>
    </div>
<?php
}
$posts->closeCursor();
?>

<form action="index.php?action=addChapter" method="post">
    <div>
        
        <p>Ajouter un chapitre</p>
        <label for="title">Titre</label><br />
        <input type="text" id="title" name="title" />
    </div>
    <div>
        <label for="content">Contenu</label><br />
        <input type="text" id="content" name="content" />
    </div>
    <div>
        <input type="submit" />
    </div>
    </form>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?><!--attendre le chargement des données avant l'appel à template-->
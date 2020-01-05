

<?php $title = "interface admin"; ?>

<?php ob_start(); ?>

<h1>interface admin - Ajout de chapitre</h1>

<div class="linkAdmin">
    <em><a href="/index.php">Retour à la liste des billets</a></em><br />
</div>

<div class="news">

    <form action="index.php?action=addChapter" method="post">
        <div>

            <p>Ajouter un chapitre</p>
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="title" />
        </div>
        <div>
            <label for content ="content">Contenu du chapitre</label><br />
            <textarea type="text" class="default" name="content"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>
</div>
   
<?php $content = ob_get_clean(); ?>

<?php require(BACK_VIEW_DIR.'/template.php'); ?><!--attendre le chargement des données avant l'appel à template-->

<?php $title = "interface admin"; ?>

<?php ob_start(); ?>

<h1>interface admin - Ajout de chapitre</h1>


<article class="news addChapView">
    <form action="index.php?action=addChapter" method="POST">

        <div class="addChapView title">
            <h2>Ajouter un chapitre<h2>
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="title" />
        </div>

        <div class="addChapView">
            <label class="addChapViewLabel" for="" content="content">Contenu du chapitre</label><br />
            <textarea type="text" id="default" name="content"></textarea>
        </div>

        <div class="addChapViewBtn">
            <input class="btn btn-secondary" type="submit" />
        </div>

    </form>
</article>


<?php $content = ob_get_clean();

 require(BACK_VIEW_DIR . '/template.php');
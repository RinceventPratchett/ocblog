<!DOCTYPE html>


<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" />
        <script src="</public/tinyMVC/tinyMVC" type="text/javascript">// <![CDATA[
        /tiny_mce/tiny_mce.js">
        // ]]></script>
        <script type="text/javascript">// <![CDATA[
        tinyMCE.init({
            mode : "textareas",
            language : "fr",
            theme : "simple"
        });
        // ]]></script>
    </head>
        
    <body>
        <?= $content ?>
    </body>
</html>
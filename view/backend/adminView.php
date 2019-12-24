<?php
$title = 'Interface administration'; 
?>

<?php 
ob_start(); 
?>

<!--<form action="traitement.php" method="post"><textarea style="width: 100%;" name="content"><br /> </textarea>
<input name="send" type="submit" value="Envoyer" /></form>-->

<?php

$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>   
    
    
<?php require('template.php'); ?><!--attendre le chargement des données avant l'appel à template-->

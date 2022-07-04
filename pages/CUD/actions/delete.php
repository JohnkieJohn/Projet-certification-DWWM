<?php

/* Contrôle la suppresion d'un article dans la db */

require 'vendor/autoload.php';
use project\library\Products;
    
if (!empty($_POST["line_index"]))
{
    $id_article = $_POST["line_index"];

    $db = new Products();
    $data = $db->delete($id_article);
    header('location: ?page=remove');
}
else
{
    echo '<span class="error">Erreur, veuillez sélectionner un article à supprimer.</span>';
    echo '<ul><li><a href="./?page=backoffice">Revenir au menu du backoffice</a></li></ul>';
}

?>
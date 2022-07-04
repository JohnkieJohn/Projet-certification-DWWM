<?php

/* Contrôle la modification d'un article dans la db */

require 'vendor/autoload.php';
use project\library\Products;

    
if (!empty($_POST["option_selected"]) && !empty($_POST["ref"]) && !empty($_POST['prixunit']))
{
    $id_article = $_POST['line_index'];
    $name = $_POST['option_selected'];
    $ref = $_POST['ref'][0];
    $price = $_POST['prixunit'];

    $db = new Products();
    $data = $db->update($id_article, $name, $ref, $price); 
    header('location: ?page=modify'); 
}
else if (empty($_POST["artcl"]) || empty($_POST["rfr"][0]) || empty($_POST["prx"]))
{
    echo '<span class="error">Erreur, veuillez sélectionner un article à modifier.</span>';
    echo '<ul><li><a href="./?page=backoffice">Revenir au menu du backoffice</a></li></ul>';
}

?>
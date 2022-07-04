<?php

/* Contrôle l'insertion d'un ou plusieurs articles dans la db */

require 'vendor/autoload.php';
use project\library\Products;
    
if (!empty($_POST["artcl"]) && !empty($_POST["rfr"]) && !empty($_POST['prx']))
{
    $name = $_POST["artcl"];
    $ref = $_POST["rfr"];
    $price = $_POST['prx'];

    $db = new Products();
    $data = $db->insert($name,$ref, $price); 
    header('location: ?page=backoffice');
}
else if (empty($_POST["artcl"]) || empty($_POST["rfr"]) || empty($_POST["prx"]))
{
    echo '<span class="error">Erreur, un ou plusieurs champs sont restés vides, recommencez la saisie.</span>';
    echo '<ul><li><a href="./?page=backoffice">Revenir au menu du backoffice</a></li></ul>';
}

?>
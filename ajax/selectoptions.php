<?php

/* Génère des options pour le menu select du bon de commande avec les noms des articles dans la db */

require '../vendor/autoload.php';
use project\library\Products;

$db = new Products();
$data = $db->getNames();

while($result = $data->fetch(PDO::FETCH_ASSOC))
{
    echo '<option value="'.$result['article_nom'].'">'.$result['article_nom'].'</option>';
}

?>
<?php

/* Recherche dans la page catalogue */

/* A SUPPRIMER (OBSOLETE) */

require '../vendor/autoload.php';
use project\library\Products;

$token = $_GET['t'];

$db = new Products();
$data = $db->searchProducts($token);

while($result = $data->fetch(PDO::FETCH_ASSOC))
{
    echo '<div class="line">';
    echo '<div class="line-details">'.$result['article_nom'].'</div><div class="line-details">'.$result['article_ref'].'</div><div class="line-details">'.number_format($result['article_prix'], 2, '.', '').' €</div>';
    echo '</div>';
}

?>
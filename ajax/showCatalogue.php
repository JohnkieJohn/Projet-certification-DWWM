<?php

/* Génère une liste des produits pour la page catalogue */

require '../vendor/autoload.php';

use project\library\Products;

if (isset($_GET['s']))
{
    $filter = $_GET['s']; // Gère le filtre d'affichage du catalogue
}

if (!empty($_GET['t']))
{
    $token = $_GET['t']; // Gère la recherche par libellé d'article
    $search = "WHERE article_nom LIKE '".$token."%'";
}
else 
{
    $search = '';
}

$db = new Products();
$data = $db->productFilter($filter, $search);

while($result = $data->fetch(PDO::FETCH_ASSOC))
{
    echo '<div class="line">';
    echo '<div class="line-details">'.$result['article_nom'].'</div><div class="line-details">'.$result['article_ref'].'</div><div class="line-details">'.number_format($result['article_prix'], 2, '.', '').' €</div>';
    echo '</div>';
}
    
?>
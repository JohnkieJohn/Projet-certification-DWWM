<?php

/* Récupère l'id du produit (pour les pages relatives au back-office) */

require '../vendor/autoload.php';
use project\library\Products;

$name = $_GET['s'];

$db = new Products();
$data = $db->getId($name);

$result = $data->fetch(PDO::FETCH_NUM);

echo $result[0];

?>
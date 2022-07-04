<?php

/* Récupère le prix de l'article */

require '../vendor/autoload.php';
use project\library\Products;

$name = $_GET['p'];

$db = new Products();
$data = $db->getPrice($name);
$result = $data->fetch(PDO::FETCH_NUM);

echo $result[0];

?>
<?php

/* Récupère la référence de l'article */

require '../vendor/autoload.php';
use project\library\Products;

$name = $_GET['r'];

$db = new Products();
$data = $db->getRef($name);
$result = $data->fetch(PDO::FETCH_NUM);

echo $result[0];

?>
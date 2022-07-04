<?php

/* Affiche les commandes relatives à un utilisateur */

require './vendor/autoload.php';

use project\library\Orders;
use project\library\OrderDetails;

if (isset($_POST['id_user']))
{
    $id_user = $_POST['id_user'];
}
else
{
    $id_user = $_SESSION['id_user'];
}

$db = new Orders();
$data = $db->getOrderId($id_user);

echo '<h2>Mes commandes :</h2>';
echo '<hr>';

while($result = $data->fetch(PDO::FETCH_ASSOC))
{

    $id_order = $result['id_commande'];

    $db2 = new Orders();
    $data2 = $db2->getOrder($id_user, $id_order);
    $result2 = $data2->fetch(PDO::FETCH_ASSOC);

    echo '<p>Commande passée le : '.$result2['commande_date'].'</p>';
    echo '<p>pour un total de '.$result2['total'].'€</p>';
    echo '<p>Détails de la commande :</p>';

    $db3 = new OrderDetails('', '');
    $data3 = $db3->getOrderDetails($id_user, $id_order);
    while ($result3 = $data3->fetch(PDO::FETCH_ASSOC))
    {
        echo '<p>article : '.$result3['article_nom'].'</p>';
        echo '<p>quantité : '.$result3['quantite'].'</p>';
    }
    echo '<hr>';
}

?>
<?php

require './vendor/autoload.php';
use project\library\Orders;
use project\library\OrderDetails;

/* Enregistrement dans la db d'une commande utilisateur */

if (!empty($_POST['total_order']) && $_POST['total_order'] != 0)
{
    $id_user = $_SESSION['id_user'];
    $total = $_POST['total_order'];

    $db = new Orders();
    $data = $db->registerOrder($id_user, $total);
    $db = new OrderDetails ($_POST['ref'], $_POST['qte']);
    $data = $db->orderLines($id_user);
    echo '<span class="ok">Commande enregistrée !</span>';
}
else
{
    echo '<span class="error">Erreur sur la commande, veuillez recommencer.</span>';
    echo '<ul><li><a href="./?page=commande">Accéder au bon de commande</a></li></ul>';
}

?>
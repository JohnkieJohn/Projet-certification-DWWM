<?php

/* Génère une liste des utilisateurs */

require '../vendor/autoload.php';
use project\library\Users;

if ($_GET['s'] = 'show')
{
    $db = new Users ();
    $conn = $db->getAllUsers();

    while ($result = $conn->fetch(PDO::FETCH_ASSOC))
    {
        echo '<form action="./?page=userOrder" method="post">';
        echo '<ul>';
        echo '<li><input type="number" name="id_user" hidden value="'.$result['id_user'].'"> 
        '.$result['user_login'].' '.$result['user_prenom'].' '.$result['user_nom'].' '.$result['user_email'].'</li>';
        echo '<li><input type="submit" value="Voir les commandes de cet utilisateur"></li>';
        echo '</ul>';
        echo '</form>';
        echo '<form action="./?page=delete-user" method="post">';
        echo '<ul>';
        echo '<li><input type="number" name="id_user" hidden value="'.$result['id_user'].'">';
        echo '<li><input type="submit" value="Supprimer cet utilisateur"></li>';
        echo '</ul>';
        echo '</form>';
    }
}

?>
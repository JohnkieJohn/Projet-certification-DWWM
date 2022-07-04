<?php 

/* Déconnexion */

session_start();
$_SESSION["user"] = "";
session_destroy();
header('Location: ?page=connexion');

?>
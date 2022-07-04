<?php

session_start();

/* Assigne à la variable $path la valeur de $page envoyée en GET via les liens (permet de naviguer de page en page) */

$rootsite = $_SERVER["PHP_SELF"];
if(isset($_GET["page"]))
{
    $page = $_GET["page"];
    switch ($page)
    {
        case "backoffice" :
            $path = "./pages/backoffice.php";
            break;
        case "add" :
            $path = "./pages/CUD/add.php";
            break;
        case "modify" :
            $path = "./pages/CUD/modify.php";
            break;
        case "remove" :
            $path = "./pages/CUD/remove.php";
            break;
        case "insert" :
            $path = "./pages/CUD/actions/insert.php";
            break;
        case "update" :
            $path = "./pages/CUD/actions/update.php";
            break;
        case "delete" :
            $path = "./pages/CUD/actions/delete.php";
            break;
        case "catalogue" :
            $path = "./pages/catalogue.php";
            break;
        case "commande" :
            $path = "./pages/commande.php";
            break;
        case "userOrder" :
            $path = "./pages/userOrder.php";
            break;
        case "usersList" :
            $path = "./pages/usersList.php";
            break;
        case "inscription" :
            $path = "./controllers/inscription.php";
            break;
        case "identification" :
            $path = "./controllers/identification.php";
            break;
        case "validate-order" :
            $path = "./controllers/validate-order.php";
            break;
        case "delete-user" :
            $path = "./controllers/delete-user.php";
            break;
        case "connexion" :
            $path = "./pages/connexion.php";
            break;
        case "deconnexion" :
            $path = "./pages/deconnexion.php";
            break;
        default:
            $path = "./pages/connexion.php";
    }
}
else
{
    $_GET['page']="connexion";
    $path = './pages/connexion.php';     
    header('location: ?page=connexion');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de commande</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include('inc/_nav.php'); ?>
    <?php
        if(!empty($_SESSION)) 
        {
            if ($_SESSION["user"] === "admin")
            {
                echo "<span class='ok'>Connecté en tant qu'administrateur</span>";
            }
            else
            {
                echo '<span class="ok">Bonjour '.$_SESSION['user'].'</span>';
            }
        }
    ?>
    <div class="wrapper">
        <?php

            /* Inclut l'URL récupérée à l'aide du routeur plus haut par le biais de $path pour afficher la page en cours */
            include($path);

        ?>
    </div>
    <script src="script/jquery-3.6.0.min.js"></script>
    <script src="script/script.js"></script> 
</body>
</html>
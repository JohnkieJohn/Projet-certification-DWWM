<?php

/* Identification d'un utilisateur ou d'un administrateur */

require './vendor/autoload.php';
use project\library\Users;

if (!empty($_POST["login_co"]) && !empty($_POST["mdp_co"]))
{

    if ($_POST["login_co"] === "admin" && $_POST["mdp_co"] === "admin") // Si correspond aux identifiants administrateurs
    {
        $_SESSION["user"] = "admin";
        header('location: ?page=backoffice');
    }
    else // Si ne sont pas des identifiants administrateurs
    {
        $login = $_POST["login_co"];
        $mdp = $_POST["mdp_co"];

        $db = new Users();
        $data = $db->connexionUser($login);
        $result = $data->fetch(PDO::FETCH_ASSOC);

        if (!empty($result)) // Si le pseudo est bien présent dans la db
        {
            if (password_verify($mdp, $result["user_mdp"])) // Si le mot de passe correspond à celui présent dans la db
            {
                $db = new Users();
                $data = $db->getUserId($login);
                $result = $data->fetch(PDO::FETCH_NUM);
                $_SESSION['id_user'] = $result[0];
                $_SESSION['user'] = $login;
                header('location: ?page=catalogue');
            }
            else
            {
                echo "Mot de passe incorrect.";
            }
        }
        else
        {
            echo "Utilisateur non reconnu.";
        }
    }

}

?>
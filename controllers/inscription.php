<?php

/* Inscription d'un nouvel utilisateur */

require './vendor/autoload.php';
use Valitron\Validator;
use project\library\Users;

$rules = [
    'required' => ['login', 'prenom', 'nom', 'email', 'mdp'],
    'alphaNum' => 'login',
    'alpha' => ['prenom', 'nom'],
    'email' => 'email'
];

/* Validator vérifie les champs relatifs à l'inscription, selon les règles énoncées plus haut */

$validator = new Validator($_POST);
$validator->rules($rules);

if ($validator->validate()) // Si les règles sont respectées
{
    $login = $_POST["login"];
    $email = $_POST["email"];
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $mdp = $_POST["mdp"];

    $db = new Users();
    $data = $db->checkUser($login, $email);
    $result = $data->fetch();

    if (empty($result)) // Si le pseudo choisit n'est pas déjà présent dans la db
    {
        $hashed_mdp = password_hash($mdp, PASSWORD_DEFAULT);
        $db = new Users();
        $data = $db->insertUser($login, $prenom, $nom, $email, $hashed_mdp);
        $db = new Users ();
        $data = $db->getUserId($login);
        $result = $data->fetch(PDO::FETCH_NUM);
        $_SESSION['user'] = $login;
        $_SESSION['id_user'] = $result[0];
        header('location: ?page=catalogue');
    }
    else
    {
        echo "Ce pseudo ou cet email est déjà enregistré. Recommencez.";
    }
} 
else
{
    /* Affiche les différentes erreurs relatives aux règles non respectées */

    $errors = $validator->errors(); 

    foreach ($errors as $arr) { 
        foreach ($arr as $error) {
            echo $error . "\n";
        }
    };
}

?>
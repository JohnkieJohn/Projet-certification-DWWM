<?php

/* Fonctions et requêtes SQL relatives aux utilisateurs */

namespace project\library;
use \PDO;

    class Users extends DatabaseConnect
    {

        public function __construct()
        {
            parent::__construct();
        }

        public function insertUser($login, $prenom, $nom, $email, $hashed_mdp)
        {
            $data = $this->connexion()->prepare(
                "INSERT INTO users_infos (user_login, user_prenom, user_nom, user_email, user_mdp) 
                VALUES (:pseudo, :prenom, :nom, :email, :mdp)");

            $data->bindParam(":pseudo",  $login, PDO::PARAM_STR);
            $data->bindParam(":prenom", $prenom, PDO::PARAM_STR);
            $data->bindParam(":nom", $nom, PDO::PARAM_STR);
            $data->bindParam(":email", $email, PDO::PARAM_STR);
            $data->bindParam(":mdp", $hashed_mdp, PDO::PARAM_STR);
            $data->execute();
        }

        public function checkUser($login, $email)
        {
            $data = $this->connexion()->prepare(
                "SELECT * FROM users_infos 
                WHERE user_login = :pseudo AND  user_email = :email");

            $data->bindParam(':pseudo', $login, PDO::PARAM_STR);
            $data->bindParam(":email", $email, PDO::PARAM_STR);
            $data->execute();
            return $this->data = $data;
        }

        public function connexionUser($login)
        {
            $data = $this->connexion()->prepare(
                "SELECT * FROM users_infos 
                WHERE user_login = :pseudo /*AND user_mdp = :mdp*/");

            $data->bindParam(':pseudo', $login, PDO::PARAM_STR);
            /*$data->bindParam(':mdp', $this->mdp, PDO::PARAM_STR);*/
            $data->execute();
            return $this->data = $data;
        }

        public function getUserId($login)
        {
            $data = $this->connexion()->prepare(
                "SELECT id_user FROM users_infos 
                WHERE user_login = :pseudo");
            $data->bindParam(':pseudo', $login, PDO::PARAM_STR);
            $data->execute();
            return $this->data = $data;
        }

        public function getAllUsers()
        {
            $data = $this->connexion()->prepare(
                "SELECT * FROM users_infos");
            $data->execute();
            return $this->data = $data;
        }

        public function searchListUsers($token)
        {
            $data = $this->connexion()->prepare(
                "SELECT * FROM users_infos 
                WHERE user_login LIKE :search");
            $data->bindParam(':search', $token, PDO::PARAM_STR);
            $data->execute();
            return $this->data = $data;
        }

        public function deleteUser($id_user)
        {
            $data = $this->connexion()->prepare(
                "DELETE FROM users_infos
                WHERE users_infos.id_user = :id");
            $data->bindParam(':id', $id_user, PDO::PARAM_INT);
            $data->execute();
        }

    }

?>
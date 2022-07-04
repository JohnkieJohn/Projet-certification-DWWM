<?php

/* Connexion à la base de données, parent class */

namespace project\library;
use \PDO;

    class DatabaseConnect
    {
        private $pdo;

        protected function __construct()
        {
            $this->PARAM_hote='localhost';
            $this->PARAM_port='3306';
            $this->PARAM_nom_bd='bon_de_commande';
            $this->PARAM_utilisateur='root';
            $this->PARAM_mot_passe='';
        }

        protected function connexion()
        {
            if($this->pdo === null) // Si la connexion à la bdd n'a pas déjà été établie
            {
                try
                {
                    $pdo = new PDO("mysql:host=".$this->PARAM_hote."; port=".$this->PARAM_port."; dbname=".$this->PARAM_nom_bd.";
                    charset=utf8", $this->PARAM_utilisateur, $this->PARAM_mot_passe);
                }
                catch (Exception $e)
                {
                    die("Erreur : " .$e->getMessage());
                }
            }
            return $this->pdo = $pdo;
        }
    }

?>
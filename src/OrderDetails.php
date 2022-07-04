<?php

/* Fonctions et requêtes SQL relatives au détail des commandes */

namespace project\library;
use \PDO;

    class OrderDetails extends DatabaseConnect
    {
        public $ref;
        public $quantite;

        public function __construct($ref, $quantite)
        {
            parent::__construct();
            $this->ref = $ref;
            $this->quantite = $quantite;
        }

        public function orderLines($id_user)
        {
            $ligne = 1;
            $data = $this->connexion()->prepare(
                "INSERT INTO commande_details (commande_id, commande_ligne, article_ref, quantite) 
                SELECT commande.id_commande, :ligne, :ref, :quantite 
                FROM commande
                WHERE user_id_ = :id ORDER BY commande.id_commande DESC LIMIT 1");

            for ($i=0; $i < sizeof($this->ref); $i++)
            {
                $data->bindParam(":ligne",  $ligne, PDO::PARAM_STR);
                $data->bindParam(":ref", $this->ref[$i], PDO::PARAM_STR);
                $data->bindParam(":quantite", $this->quantite[$i], PDO::PARAM_INT);
                $data->bindParam(":id", $id_user, PDO::PARAM_INT);
                $data->execute();
                $ligne++;
            }
        }

        public function  getOrderDetails($id_user, $id_order)
        {
            $data = $this->connexion()->prepare(
                "SELECT article_nom, quantite FROM commande_details 
                INNER JOIN article_infos ON article_infos.article_ref = commande_details.article_ref 
                INNER JOIN commande ON commande_details.commande_id = commande.id_commande 
                WHERE user_id_ = :id AND id_commande = :idOrder");
            $data->bindParam(':id', $id_user, PDO::PARAM_INT);
            $data->bindParam(':idOrder', $id_order, PDO::PARAM_INT);
            $data->execute();
            return $this->data = $data;
        }
    }

?>
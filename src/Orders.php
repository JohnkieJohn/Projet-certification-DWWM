<?php

/* Fonctions et requêtes SQL relatives aux commande */

namespace project\library;
use \PDO;

    class Orders extends DatabaseConnect
    {

        public function __construct()
        {
            parent::__construct();
        }

        public function registerOrder($id_user, $total)
        {
            $data = $this->connexion()->prepare(
                "INSERT INTO commande (user_id_, total) 
                VALUES (:user_id_, :total)");
            $data->bindParam(":user_id_", $id_user, PDO::PARAM_INT);
            $data->bindParam(":total", $total, PDO::PARAM_STR);
            $data->execute();
        }

        public function getOrderId($id_user)
        {
            $data = $this->connexion()->prepare(
                "SELECT id_commande FROM commande 
                WHERE user_id_ = :id");
            $data->bindParam(':id', $id_user, PDO::PARAM_INT);
            $data->execute();
            return $this->data = $data;
        }

        public function getOrder($id_user, $id_order)
        {
            $data = $this->connexion()->prepare(
                "SELECT commande_date, total FROM commande 
                WHERE user_id_ = :id AND id_commande = :idOrder");
            $data->bindParam(':id', $id_user, PDO::PARAM_INT);
            $data->bindParam(':idOrder', $id_order, PDO::PARAM_INT);
            $data->execute();
            return $this->data = $data;
        }

        public function deleteOrder($id_user)
        {
            $data = $this->connexion()->prepare(
                "DELETE commande.*, commande_details.*
                FROM commande
                LEFT JOIN commande_details
                ON commande.id_commande = commande_details.commande_id
                WHERE commande.user_id_ = :id");
            $data->bindParam(':id', $id_user, PDO::PARAM_INT);
            $data->execute();
        }

    }

?>
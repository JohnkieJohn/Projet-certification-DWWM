<?php

/* fonctions et requêtes SQL relatives aux articles */

namespace project\library;
use \PDO;

    class Products extends DatabaseConnect
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function insert($name, $ref, $price)
        {
            $data = $this->connexion()->prepare(
                "INSERT INTO article_infos (article_nom, article_ref, article_prix) 
                VALUES (:article, :reference, :prix)");

            for ($i=0; $i < sizeof($name); $i++)
            {
                $data->bindParam(":article",  $name[$i], PDO::PARAM_STR);
                $data->bindParam(":reference", $ref[$i], PDO::PARAM_STR);
                $data->bindParam(":prix", $price[$i], PDO::PARAM_STR);
                $data->execute();
            }
        }

        public function update($id_article, $name, $ref, $price)
        {
            $data = $this->connexion()->prepare(
                "UPDATE commande_details
                INNER JOIN  article_infos ON article_infos.article_ref = commande_details.article_ref 
                SET commande_details.article_ref = :reference WHERE id_article = :id;
                UPDATE article_infos SET article_nom = :article, article_ref = :reference, article_prix = :prix  
                WHERE id_article = :id");
            $data->bindParam(":article",  $name, PDO::PARAM_STR);
            $data->bindParam(":reference", $ref, PDO::PARAM_STR);
            $data->bindParam(":prix", $price, PDO::PARAM_STR);
            $data->bindParam(":id", $id_article, PDO::PARAM_INT);
            $data->execute();
        }

        public function delete($id_article)
        {
            $data = $this->connexion()->prepare(
                "DELETE FROM article_infos 
                WHERE id_article = :id");
            $data->bindParam(":id", $id_article, PDO::PARAM_INT);
            $data->execute();
        }

        /*public function searchProducts($token)
        {
            ---------- OBSOLETE ----------

            $data = $this->connexion()->prepare(
                "SELECT * FROM article_infos 
                WHERE article_nom LIKE :search");
            $data->bindParam(':search', $token, PDO::PARAM_STR);
            $data->execute();
            return $this->data = $data;
        }*/

        public function getNames()
        {
            $data = $this->connexion()->prepare(
                "SELECT article_nom FROM article_infos");
            $data->execute();
            return $this->data = $data;
        }

        public function getId($name)
        {
            $data = $this->connexion()->prepare(
                "SELECT id_article FROM article_infos 
                WHERE article_nom = :article");
            $data->bindParam(':article', $name, PDO::PARAM_STR);
            $data->execute();
            return $this->data = $data;
        }

        public function getPrice($name)
        {
            $data = $this->connexion()->prepare(
                "SELECT article_prix FROM article_infos 
                WHERE article_nom = :article");
            $data->bindParam(':article', $name, PDO::PARAM_STR);
            $data->execute();
            return $this->data = $data;
        }

        public function getRef($name)
        {
            $data = $this->connexion()->prepare(
                "SELECT article_ref FROM article_infos 
                WHERE article_nom = :article");
            $data->bindParam(':article', $name, PDO::PARAM_STR);
            $data->execute();
            return $this->data = $data;
        }

        public function productFilter($filter, $search)
        {
            switch($filter)
            {
                case '1' :
                    $sql = "ORDER BY article_prix ASC";
                    break;
                case '2' :
                    $sql = "ORDER BY article_prix DESC";
                    break;
                case '3' :
                    $sql = "ORDER BY article_nom ASC";
                    break;
                case '4' :
                    $sql = "ORDER BY article_nom DESC";
                    break;
                default :
                    $sql = "";
            }

            if ($search != '' && $sql != '')
            {
                $data = $this->connexion()->prepare("SELECT * FROM article_infos ".$search." ".$sql);
            }
            else
            {
                if ($sql != '')
                {
                    $data = $this->connexion()->prepare("SELECT * FROM article_infos ".$sql);
                }
                else if ($search != '')
                {
                    $data = $this->connexion()->prepare("SELECT * FROM article_infos ".$search."");
                }
                else
                {
                    $data = $this->connexion()->prepare("SELECT * FROM article_infos");
                }
                
            }
            $data->execute();
            return $this->data = $data;
        }

        /*public function getIdByRef()
        {
            $data = $this->connexion()->prepare(
                "SELECT id_article FROM article_infos 
                WHERE article_ref = :reference");
            $data->bindParam(':reference', $this->ref, PDO::PARAM_STR);
            $data->execute();
            return $this->data = $data;
        }*/

    }

?>
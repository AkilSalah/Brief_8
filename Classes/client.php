<?php

class Client {
    private $db;
    public function __construct($con){
        $this->db=$con;
    }
    public function selectCategory(){
        $sql = "SELECT * FROM categories";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function searchProduct($search){
        $sql = "SELECT * FROM plants 
                JOIN categories ON categories.id_cat = plants.category_id  
                WHERE name_plant = '$search'";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }    
    public function selectProduct(){
        $sql = "SELECT * FROM plants JOIN categories ON categories.id_cat = plants.category_id ";
        $stmt = $this->db->query($sql);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    public function filtreCategory($id_cat){
        $sql ="SELECT * FROM plants join categories on categories.id_cat = plants.category_id WHERE categories.id_cat = $id_cat";
        $stmt = $this->db->query($sql);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    public function addPanier($id_u, $id_pro) {
        $qBasket = $this->db->prepare("INSERT INTO basket (user_id, plant_id) VALUES (:user_id, :plant_id)");
        $qBasket->bindParam(':user_id', $id_u);
        $qBasket->bindParam(':plant_id', $id_pro);
        $qBasket->execute();
        $basketId = $this->db->lastInsertId();
        $pivotQuery = $this->db->prepare("INSERT INTO plant_basket_pivot (plant_id, basket_id) VALUES (:plant_id, :basket_id)");
        $pivotQuery->bindParam(':plant_id', $id_pro);
        $pivotQuery->bindParam(':basket_id', $basketId);
        $pivotQuery->execute();
        return $pivotQuery;
    }
    

    public function panierNB($id_u){
        $sql = "SELECT COUNT(*) AS nombre_de_lignes FROM basket WHERE user_id = $id_u";
        $count = $this->db->query($sql)->fetchColumn();
        return $count;
    }

    public function selectPanier($id_u){
        $sql = "select * from basket join plants on plants.id_plant = basket.plant_id where user_id = $id_u ";
        $stmt = $this->db->query($sql);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
    public function priceSum($id_u) {
        $sql = "SELECT SUM(price) AS somme FROM basket JOIN plants ON plants.id_plant = basket.plant_id WHERE basket.user_id = :id_u";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_u', $id_u);
        $stmt->execute();
        $price = $stmt->fetch(PDO::FETCH_ASSOC);
        return $price;
    }

    public function deletePanier($id){
        $sql = "delete from basket where id = $id";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function valider($id_u): void
    {
        $sqlSelect = "SELECT * FROM basket WHERE user_id = $id_u";
        $stmtSelect = $this->db->prepare($sqlSelect);
        $stmtSelect->execute();
    
        if ($stmtSelect->rowCount() > 0 ){
            $rows = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $sqlInsert = "INSERT INTO commands (date, user_id, plant_id) VALUES (NOW(), $id_u, :id_produit)";
                $stmtInsert = $this->db->prepare($sqlInsert);
                $stmtInsert->bindParam(':id_produit', $row['plant_id']);
                $stmtInsert->execute();
            }

            $sqlDelete = "DELETE FROM basket WHERE user_id = $id_u";
            $stmtDelete = $this->db->prepare($sqlDelete);
            $stmtDelete->execute();
    
            echo "La commande est valider.";
        }
         else {
            echo "No commande pour Valider.";
        }
    }
    

    
    



}


















?>
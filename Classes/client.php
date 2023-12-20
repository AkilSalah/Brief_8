<?php

class Client {
    private $db;
    private $id_category;
    private $id_user;
    private $id_produit;
    private $id_basket;
    
    
    public function __construct($con){
        $this->db=$con;
    }

    public function get_id_category(){
        return $this->id_category;
    }
    public function get_id_user(){
        return $this->id_user;
    }
    public function get_id_produit(){
        return $this->id_produit;
    }
    public function get_id_basket(){
        return $this->id_basket;
    }

    public function setId_category($id_category){
        $this->id_category=$id_category;
    }
    
    public function setId_user($id_user){
        $this->id_user=$id_user;
    }
    
    public function setId_produit($id_produit){
        $this->id_produit=$id_produit;
    }
    
    public function setId_basket($id_basket){
        $this->id_basket=$id_basket;
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

   public function filtreCategory() {
    $id_cat = $this->get_id_category();
    $sql = "SELECT * FROM plants JOIN categories ON categories.id_cat = plants.category_id WHERE categories.id_cat = :id_cat";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_cat', $id_cat);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $products;
}

public function addPanier() {
    $userId = $this->get_id_user();
    $plantId = $this->get_id_produit();

    $qBasket = $this->db->prepare("INSERT INTO basket (user_id, plant_id) VALUES (:user_id, :plant_id)");
    $qBasket->bindParam(':user_id', $userId);
    $qBasket->bindParam(':plant_id', $plantId);
    $qBasket->execute();

    $basketId = $this->db->lastInsertId();

    $pivotQuery = $this->db->prepare("INSERT INTO plant_basket_pivot (plant_id, basket_id) VALUES (:plant_id, :basket_id)");
    $pivotQuery->bindParam(':plant_id', $plantId);
    $pivotQuery->bindParam(':basket_id', $basketId);
    $pivotQuery->execute();

    return $pivotQuery;
}

    

    public function panierNB() {
        $id_user =$this->get_id_user();
        $sql = "SELECT COUNT(*) AS nombre_de_lignes FROM basket WHERE user_id = :id_u";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_u', $id_user);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
    

    public function selectPanier(){
        $user_id=$this->get_id_user();
        $sql = "select * from basket join plants on plants.id_plant = basket.plant_id where user_id = :id_u ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_u', $user_id );
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
    public function priceSum() {
        $user_id=$this->get_id_user();
        $sql = "SELECT SUM(price) AS somme FROM basket JOIN plants ON plants.id_plant = basket.plant_id WHERE basket.user_id = :id_u";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_u', $user_id );
        $stmt->execute();
        $price = $stmt->fetch(PDO::FETCH_ASSOC);
        return $price;
    }

    public function deletePanier(){
        if($this->get_id_basket() !== null) {
            $idbasket = $this->get_id_basket();
        }
        $sql = "delete from basket where id = :id";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':id', $idbasket );
        $stmt->execute();
        return $stmt;
    }

    public function valider()  {
        $user_id = $this->get_id_user();
        $sqlSelect = "SELECT * FROM basket WHERE user_id = :id_u";
        $stmtSelect = $this->db->prepare($sqlSelect);
        $stmtSelect->bindParam(':id_u', $user_id);
        $stmtSelect->execute();
    
        if ($stmtSelect->rowCount() > 0) {
            $rows = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $sqlInsert = "INSERT INTO commands (date, user_id, plant_id) VALUES (NOW(), :id_u, :id_produit)";
                $stmtInsert = $this->db->prepare($sqlInsert);
                
                $user_id_for_bind = $this->get_id_user();
                
                $stmtInsert->bindParam(':id_u', $user_id_for_bind);
                $stmtInsert->bindParam(':id_produit', $row['plant_id']);
                $stmtInsert->execute();
            }
                $sqlDelete = "DELETE FROM basket WHERE user_id = :id_u";
                $stmtDelete = $this->db->prepare($sqlDelete);
                
                $stmtDelete->bindParam(':id_u', $user_id_for_bind);
                
                $stmtDelete->execute();
                
        }   
           
        header('location: ../Pages/client.php'); 
        exit();

        
    }
    
}

?>
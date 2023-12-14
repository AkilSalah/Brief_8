<?php
class  Admin {
    private $db;

    public function __construct($con){
        $this->db=$con;
    }

    public function addCategory($nom){
        $sql = "INSERT INTO categories (name) values ('$nom')";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;

    }
    public function updateCategory ($nom,$id){
        $sql = "UPDATE categories SET name = '$nom' WHERE id = '$id'";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function deleteCategory ($id){
        $sql = "DELETE FROM categories WHERE id = '$id'";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function afficherCategory (){
        $sql = "SELECT * FROM categories";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    










}

?>
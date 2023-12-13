<?php

class User {
    private $db;

    public function __construct($con) {
        $this->db = $con;
    }

    public function insertUser($nom, $prenom, $email, $password) {
        $sql = "INSERT INTO users (nom, prenom, email, password) VALUES (:nom, :prenom, :email, :password)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt;
    }

    public function userLogin ($email,$password){
      $sql = "SELECT * FROM users WHERE email = '$email'";
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      return $stmt;
    }

}
?>

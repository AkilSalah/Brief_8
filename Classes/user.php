<?php

class User {
    private $db;
    private $nom;
    private $prenom;
    private $email;  
    private $mdp;
    public function __construct($con) {
        $this->db = $con; 
    }

    public function get_email(){
        return $this->email;
    }
    public function get_mdp(){
        return $this->mdp;
    }
    public function get_nom(){
        return $this->nom;
    }
    public function get_prenom(){
        return $this->prenom;
    }


    /// SETTERS ****************

    public function set_email($email){
        $this->email = $email;
    }
    public function set_mdp($mdp){
        $this->mdp = $mdp;
    }
    public function set_nom($nom){
        $this->nom = $nom;
    }
    public function set_prenom($prenom){
        $this->prenom = $prenom;
    }

    public function insertUser() {
        $sql = "INSERT INTO users (nom, prenom, email, password) VALUES (:nom, :prenom, :email, :password)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nom', $this->get_nom());
        $stmt->bindParam(':prenom',$this->get_prenom());
        $stmt->bindParam(':email',$this->get_email());
        $stmt->bindParam(':password',$this->get_mdp());
        $stmt->execute();
        return $stmt;
    }

    public function userLogin(){
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $this->get_email());
        $stmt->execute();
        return $stmt;
    }
}
?>

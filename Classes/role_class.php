<?php
class Role {
private $db ;
private $role;
private $email;

public function __construct($con){
    $this->db=$con;
}

public function get_email(){
    return $this->email;
}

public function get_role(){
    return $this->role;
}

public function set_email($email){
    $this->email = $email;
}

public function set_role($role){
    $this->role = $role;
}

public function userRole (){
    $sql = "UPDATE users SET user_type = :user_type where email = :email";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':email', $this->get_email());
    $stmt->bindParam(':user_type', $this->get_role());
    $stmt->execute();
    return true;
}

}

?>
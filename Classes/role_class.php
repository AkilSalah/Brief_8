<?php
class Role {
private $db ;

public function __construct($con){
    $this->db=$con;
}

public function userRole ($user_type,$email){
    $sql = "UPDATE users SET user_type = '$user_type' where email = '$email'";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
        return true;
}

}

?>
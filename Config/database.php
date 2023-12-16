<?php
$servername = "localhost";
$username = "root";
$db = "brief8";
$password = "";

try {
    $con = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

require_once("../Classes/user.php");
$user = new User($con);
require_once("../Classes/role_class.php");
$role= new Role ($con);
require_once("../Classes/admin_class.php");
$admin = new admin($con);
require_once("../Classes/client.php");
$client= new Client($con);
?>
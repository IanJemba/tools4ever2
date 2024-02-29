<?php
require 'database.php';
$id = $_GET['id'];

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$address = $_POST["address"];
$city = $_POST["city"];
$role = $_POST["role"];



$sql = "UPDATE users SET firstname = :firstname,  
        lastname = :lastname, 
        email =  :email,
        password = :password ,
        address = :address,
        city=:city,
        role=:role
        WHERE id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(":email", $email);
$stmt->bindParam(':city', $city);
$stmt->bindParam(":address", $address);
$stmt->bindParam(":password", $address);
$stmt->bindParam(":id", $id);
$stmt->bindParam(":role", $role);

if ($stmt->execute()) {
    echo " User has been updated. <a href='users_index.php'>Go back to Users</a>";
}

<?php
session_start();

require 'database.php';

if (!isset($_SESSION['user_id'])) {
    echo "You are not logged in, please login. ";
    echo "<a href='login.php'>Login here</a>";
    exit;
}

if ($_SESSION['role'] != 'admin') {
    echo "You are not allowed to view this page, please login as admin";
    exit;
}

// check method
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "You are not allowed to view this page";
    exit;
}

// check if all fields are filled in
if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['role']) || empty($_POST['address']) || empty($_POST['city']) || empty($_POST['backgroundColor']) || empty($_POST['font'])) {
    echo "Please fill in all fields";
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$role = $_POST['role'];
$address = $_POST['address'];
$city = $_POST['city'];
$is_active = 1;

// Insert user data
$sql = "INSERT INTO users (email, password, firstname, lastname, role, address, city, is_active) VALUES (:email, :password, :firstname, :lastname, :role, :address, :city, :is_active)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':role', $role);
$stmt->bindParam(':address', $address);
$stmt->bindParam(':city', $city);
$stmt->bindParam(':is_active', $is_active);
$stmt->execute();

// Get the inserted user ID
$user_id = $conn->lastInsertId();

// Insert user settings
$backgroundColor = $_POST['backgroundColor'];
$font = $_POST['font'];
$sqlSettings = "INSERT INTO user_settings (user_id, backgroundColor, font) VALUES (:user_id, :backgroundColor, :font)";
$stmtSettings = $conn->prepare($sqlSettings);
$stmtSettings->bindParam(':user_id', $user_id);
$stmtSettings->bindParam(':backgroundColor', $backgroundColor);
$stmtSettings->bindParam(':font', $font);
$stmtSettings->execute();

// Check the number of affected rows
if ($stmtSettings->rowCount() > 0) {
    header("Location: users_index.php");
} else {
    echo "Something went wrong";
}

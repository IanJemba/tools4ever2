<?php

require 'database.php';

$id = $_GET['id'];

$sql = "SELECT user_id FROM user_settings WHERE user_id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

if ($stmt->rowCount() > 0) {

    $sql = "DELETE FROM user_settings WHERE user_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    if ($stmt->execute()) {
        echo "Instellingen zijn verwijderd, ";

        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            echo "Gebruiker is eindelijk verwijderd!!!";
        }
    }
}

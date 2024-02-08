<?php

$id = $_GET['id'];

require 'database.php';

$sql = "DELETE FROM tools WHERE  tool_id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
if ($stmt->execute()) {
    header("location: tool_index.php");
    exit;
}

echo "Something went wrong";

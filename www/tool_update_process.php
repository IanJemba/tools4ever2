<?php
require 'database.php';
$id = $_GET['id'];


$name = $_POST["name"];
$category = $_POST["category"];
$price = $_POST["price"];
$brand = $_POST["brand"];
$image = $_POST["image"];
$sql = "UPDATE tools SET tool_name = :name,
        tool_category = :category,
        tool_price = :price,
        tool_brand = :brand,
        tool_image = :image
        WHERE tool_id = $id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(":name", $name);
$stmt->bindParam(":category", $category);
$stmt->bindParam(":price", $price);
$stmt->bindParam(":brand", $brand);
$stmt->bindParam(":image", $image);

if ($stmt->execute()) {
        header("Location: tool_index.php");
        exit;
}

echo "Something went wrong";

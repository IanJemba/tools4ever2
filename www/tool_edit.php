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
$id = $_GET['id'];

$sql = "SELECT * FROM tools WHERE tool_id = :tool_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':tool_id', $id);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    $tool = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    require 'header.php';
    echo "<main>";
    echo "Geen gebruiker gevonden met deze  ID.";
    exit;
}

require 'header.php';
?>

<main>
    <h1>Edit Tool</h1>
    <div class="container">
        <form action="tool_update_process.php?id=<?php echo $tool['tool_id'] ?>" method="post" enctype="multipart/form-data">
            <div>
                <label for="name">Naam:</label>
                <input type="text" id="name" name="name" value="<?php echo $tool['tool_name']; ?>">
            </div>
            <div>
                <label for="category">Categorie:</label>
                <input type="text" id="category" name="category" value="<?php echo $tool['tool_category']; ?>">
            </div>
            <div>
                <label for="price">Prijs:</label>
                <input type="number" id="price" name="price" value="<?php echo $tool['tool_price']; ?>">
            </div>
            <div>
                <label for="brand">Merk:</label>
                <input type="text" id="brand" name="brand" value="<?php echo $tool['tool_brand']; ?>">
            </div>
            <div>
                <label for="image">Afbeelding:</label>
                <input type="file" id="image" name="image" value="<?php echo $tool['tool_image']; ?>">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</main>

<?php require 'footer.php' ?>
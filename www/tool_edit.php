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

$sql = "SELECT  * FROM tools WHERE tool_id= :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
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
        <form action="tool_edit_process.php?id=<?php echo $tool['id'] ?>" method="post">
            <div>
                <label for="name">Naam:</label>
                <input type="text" id="name" name="name">
            </div>
            <div>
                <label for="category">Categorie:</label>
                <input type="text" id="category" name="category">
            </div>
            <div>
                <label for="price">Prijs:</label>
                <input type="number" id="price" name="price">
            </div>
            <div>
                <label for="brand">Merk:</label>
                <input type="brand" id="brand" name="brand">
            </div>
            <div>
                <label for="image">Afbeelding:</label>
                <input type="text" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-success">Toevoegen</button>
        </form>
    </div>
</main>
<?php require 'footer.php' ?>
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

$sql = "SELECT * FROM users LEFT JOIN user_settings ON user_settings.user_id = users.id WHERE users.id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$tools = $stmt->fetch(PDO::FETCH_ASSOC);

require 'header.php';
?>

<main>
    <div class="container">
        <?php if (isset($tools)) : ?>
            <div class="user-detail">
                <h3><?php echo $tools['firstname'] ?></h3>
                <p><?php echo $tools['lastname'] ?></p>
                <p><?php echo $tools['email'] ?></p>
                <p><?php echo $tools['role'] ?></p>
                <p><?php echo $tools['address'] ?></p>
                <p><?php echo $tools['city'] ?></p>
                <p><?php echo $tools['is_active'] == 1 ? "is actief" : "Is niet actief" ?></p>
                <p><?php echo $tools['backgroundColor'] ?></p>
                <p><?php echo $tools['font'] ?></p>
            </div>
        <?php else : ?>
            Geen gebruiker gevonden
        <?php endif; ?>
    </div>
</main>

<?php require 'footer.php' ?>
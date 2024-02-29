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
$id =  $_GET["id"];

$sql = "SELECT * FROM users WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    require 'header.php';
    echo "<main>";
    echo "Geen gebruiker gevonden met deze  ID.";
    exit;
}

require 'header.php';

?>

<main>
    <div class="container">
        <?php if (isset($user)) : ?>
            <div class="user-detail">
                <h3><?php echo $user['firstname'] ?></h3>
                <p><?php echo $user['lastname'] ?></p>
                <p><?php echo $user['email'] ?></p>
                <p><?php echo $user['role'] ?></p>
                <p><?php echo $user['address'] ?></p>
                <p><?php echo $user['city'] ?></p>
            <?php else : ?>
                Geen gebruiker gevonden
            <?php endif; ?>
            </div>
    </div>
    <div class="container">
        <form action="users_update.php?id=<?php echo $user['id']; ?>" method="post">
            <div>
                <label for="firstname">Voornaam:</label>
                <input type="text" id="firstname" name="firstname" placeholder="<?php echo $user['firstname'] ?>">
            </div>
            <div>
                <label for="lastname">Achternaam:</label>
                <input type="text" id="lastname" name="lastname" placeholder="<?php echo $user['lastname'] ?>">
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="<?php echo $user['email'] ?>">
            </div>
            <div>
                <label for="password">Wachtwoord:</label>
                <input type="password" id="password" name="password" placeholder="***********">
            </div>
            <div>
                <label for="address">Adres:</label>
                <input type="text" id="address" name="address" placeholder="<?php echo $user['address'] ?>">
            </div>
            <div>
                <label for="city">Stad:</label>
                <input type="text" id="city" name="city" placeholder="<?php echo $user['city'] ?>">
            </div>
            <div>
                <label for="backgroundColor">kleur:</label>
                <input type="color" id="backgroundColor" name="backgroundColor">
            </div>
            <div>
                <label for="city">Lettertype:</label>
                <select id='select' onChange="return fontChange();" name="font">
                </select>
            </div>
            <div>
                <label for="role">Rol:</label>
                <select id="role" name="role">
                    <option value="">Selecteer Rol</option>
                    <option value="admin">Admin</option>
                    <option value="employee">Werknemer</option>
                </select>
            </div>

            <input type="submit" class="btn btn-warning" value="Edit User">
        </form>
    </div>
</main>
<?php require 'footer.php' ?>
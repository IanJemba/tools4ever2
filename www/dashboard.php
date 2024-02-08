<?php
// Path: www/dashboard.php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You are not logged in, please login. ";
    echo "<a href='login.php'>Login here</a>";
    exit;
}


if ($_SESSION['role'] != 'admin') {
    echo "You are not allowed to view this page, please login as admin";
    exit;
}

require 'header.php';

// $sql = "SELECT * FROM users JOIN user_settings ON user_settings.user_id = users.id WHERE users.id =  1";

require 'database.php';

// $sql = "SELECT COUNT(id) AS total_users, 
//                SUM(CASE WHEN role = 'employee' THEN 1 ELSE 0 END) AS total_employees 
//         FROM users";
// $result = mysqli_query($conn, $sql);
// $data = mysqli_fetch_assoc($result);

$sql = [];
$query = "SELECT COUNT(id) AS total FROM users";
$result = mysqli_query($conn, $query);
$users = mysqli_fetch_assoc($result);

array_push($sql, $query);

$query = "SELECT COUNT(id) AS total FROM users WHERE role = 'employee'";
$result = mysqli_query($conn, $query);
$employees = mysqli_fetch_assoc($result);
array_push($sql, $query);

$query = "SELECT COUNT(tool_id) AS total FROM tools";
$result = mysqli_query($conn, $query);
$tools = mysqli_fetch_assoc($result);
array_push($sql, $query);


?>

<main class="dashboard">
    <h1>Dashboard</h1>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Welkom <?php echo $_SESSION['firstname'] ?></h2>
                <p>Je bent ingelogd als <?php echo $_SESSION['role'] ?></p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-group">
                <h2 for="">Totaal aantal gebruikers</h2>
                <p><?php echo $users['total'] ?></p>
            </div>
            <div class="card-group">
                <h2 for="">Totaal aantal medewerkers</h2>
                <p><?php echo $employees['total'] ?></p>
            </div>
            <div class="card-group">
                <h2 for="">Totaal aantal soorten gereedschap</h2>
                <p><?php echo $tools['total'] ?></p>
            </div>
        </div>
    </div>
</main>

<?php require 'footer.php' ?>
<?php

require 'header.php';
?>
<main>

    <h1>Login</h1>
    <div class="container">

        <form action="login-process.php" method="post">
            <div class="form-group">

                <label for="email">Email</label>
                <input type="text" name="email" placeholder="email">
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" name="password" placeholder="password">
            </div>
            <button name="submit" class="btn btn-success">Inloggen</button>
        </form>
    </div>
</main>
<?php require 'footer.php';

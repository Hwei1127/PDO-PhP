<?php

$db = new PDO("mysql:host=localhost;dbname=pdo_lesson", "root", "");


echo "<h1>Login (Safe)</h1>";

echo '<form method="post">
    <label>Username: <input type="text" name="username" size="30"></label><br><br>
    <label>Password: <input type="password" name="password" size="30"></label><br><br>
    <input type="submit" name="login" value="Login">
</form>';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

     $statement = $db->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $statement->execute(array(
        ':username' => $username,
        ':password' => $password
    ));

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "<p style='color:green;'>Logged in as: " . htmlspecialchars($user['username']) . "</p>";
    } else {
        echo "<p style='color:red;'>Login failed.</p>";
    }

}


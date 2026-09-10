<?php

$db = new PDO("mysql:host=localhost;dbname=pdo_lesson", "root", "");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function showUsers($db) {
    $statement = $db->prepare('SELECT id, username, email, name FROM users');
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Name</th></tr>";
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "</tr>";
    }
    echo "</table><br>";
}

echo "<h1>CRUD Operations</h1>";
showUsers($db);

// INSERT
echo "<h2>INSERT</h2>";
$statement = $db->prepare("INSERT INTO users (username, email, password, name) VALUES (:username, :email, :password, :name)");
$statement->execute(array(
    ':username' => 'frank',
    ':email'    => 'frank@example.com',
    ':password' => 'frankpass',
    ':name'     => 'Frank Castle'
));
showUsers($db);

// UPDATE
echo "<h2>UPDATE</h2>";
$statement = $db->prepare("UPDATE users SET email = :email WHERE username = :username");
$statement->execute(array(
    ':email'    => 'frank.castle@example.com',
    ':username' => 'frank'
));
showUsers($db);

// DELETE
echo "<h2>DELETE</h2>";
$statement = $db->prepare("DELETE FROM users WHERE username = :username");
$statement->execute(array(':username' => 'frank'));
showUsers($db);

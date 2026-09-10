<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=pdo_lesson", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $db->prepare("SELECT * FROM nonexistent_table");
    $statement->execute();

} catch (PDOException $e) {
    echo "<p style='color:red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}

echo "<hr>";

try {
    $db = new PDO("mysql:host=localhost;dbname=pdo_lesson", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $db->prepare("SELECT username, name FROM users LIMIT 3");
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo "<ul>";
    foreach ($rows as $row) {
        echo "<li>" . htmlspecialchars($row['name']) . " (" . htmlspecialchars($row['username']) . ")</li>";
    }
    echo "</ul>";

} catch (PDOException $e) {
    echo "<p style='color:red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}

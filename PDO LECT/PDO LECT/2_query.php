<?php

$db = new PDO("mysql:host=localhost;dbname=pdo_lesson", "root", "");

$result = $db->query('SELECT * FROM users');

echo "<h1>All Users</h1>";
echo "<ul>";

while($row = $result->fetch(PDO::FETCH_ASSOC)){
    echo "<li>".htmlspecialchars($row['username']). "-".htmlspecialchars($row['email'])."</li>";
}

echo "</ul>";





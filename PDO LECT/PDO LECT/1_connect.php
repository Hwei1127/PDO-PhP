<?php

$host = 'localhost';;
$dbname = 'pdo_lesson';
$user = 'root';
$pass = '';

$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

echo "<h1>Connection Works, PDO initialized</h1>";
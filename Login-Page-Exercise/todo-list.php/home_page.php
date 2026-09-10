<?php
session_start();

if(!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true){
    header('Location:./login.page.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charqset="UTF-8">
    <title>Home</title>
</head>
<body>

    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
    <a href="./index.php">Logout</a>

</body>
</html>
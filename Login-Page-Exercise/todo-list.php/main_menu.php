<?php
session_start();

if(!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true){
    header('Location:./index.php');
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

    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?></h2>

        <div class="card wrapping">
        <h2>My Todo list</h2>
        <div class="card list">
            
        </div>
    </div>
    <a href="./logout_page.php">Logout</a>


</body>
<style>
    .wrapping{
        padding:20px;
        width: 300px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin: auto;
    }

    a{
        padding:10px;
        color:blue;
        display:flex;
        justify-content:center;
    }
</style>

</html>
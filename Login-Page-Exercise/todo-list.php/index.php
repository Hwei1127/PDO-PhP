<?php

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email           = $_POST['email'];
    $password        = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if(empty($email) || empty($password) || empty($confirmPassword)){
        echo "All fields are required";
        exit;
    }

    if($password !==$confirmPassword){
        echo"Passwords do not match";
        exit;
    }

$db = new PDO("mysql:host=localhost;dbname=login_auth", 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//check if email exists

$check = $db->prepare("SELECT * FROM users WHERE email = :email");
$check ->execute([':email'=>$email]);

if($check->fetch()){
    echo"The email is already registered";
    exit;
}

$hashedPassword =password_hash($password,PASSWORD_DEFAULT);

$statement = $db->prepare("INSERT INTO users(email,password) VALUES(:email,:password)");
$statement->execute([
    ':email' =>$email,
    ':password'=>$hashedPassword,
]);

echo "Successfully registered";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
</head>
<body>

    <h2>My Todo List </h2>

    <a href="./login.page.php">Login</a>
    <a href="./signup.page.php">Sign Up</a>

</body>
<style>
    a{
        color: blue;
        padding-right: 20px;
    }
    </style>
</html>


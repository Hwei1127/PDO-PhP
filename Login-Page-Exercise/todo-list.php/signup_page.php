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
<div class="card">
    <h2>Sign Up a New Accont</h2>

    <hr>

    <form method="POST" action="">
        <label>Name</label><br>
        <input type="text" name="name" required><br><br>
    
        <label>Email address</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>

        <label>Confirm Password</label><br>
        <input type="password" name="confirm_password" required><br><br>

        <button type="submit">Sign Up</button>
    </form>
</div>
<div class="link">
        <a href="./index.php">Go back</a>
<div>
</body>

<style>
    .card{
        padding:30px;
        width: 300px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin: auto;
    }

    h2{
        margin: 0;
        padding: 5px;
        text-align: center;
    }


    form{
        padding: 5px;
    }

    label{
        font-size: 16px;
        margi-bottom: 5px;
    }

    input{
        border-radius: 5px ;
        border:1px solid #ddd;
        width: 95%;
        padding:5px;
        box-shadow: 0px;
    }

    button{
        background-color:#007fff;
        border: 0;
        color: white;
        font-size:16px;
        width: 100%;
        padding:10px;
        border-radius: 5px;
    }

    .link{
        text-align:center;
        padding:20px;
    }

    a{
        color:#007fff;
    }
</style>
</html>


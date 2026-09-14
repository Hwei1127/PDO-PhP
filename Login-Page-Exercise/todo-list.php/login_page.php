<?php

session_start();

if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] ==true){
    header('Location:./index.php');
    exit;
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    $email =$_POST['email'];
    $password =$_POST['password'];

    //validate inputs
    if(empty($email) || empty($password)){
        echo"All fields are required.";
        exit;
    }
    //PDO object to connect to DB
 $db = new PDO("mysql:host=localhost;dbname=login_auth", 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //check the user by email
    $statement =$db->prepare("SELECT * FROM users WHERE email = :email");
    $statement ->execute([':email'=>$email]);
    $user =$statement->fetch(PDO::FETCH_OBJ);

    //verify the password
    if($user &&password_verify($password, $user->password)){
        $_SESSION['authenticated']=true;
        $_SESSION['email'] =$user ->email;
        header('Location:./main_menu.php');
        exit;
    }else{
        echo"Invaild email or password";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<div class="card">
    <h2>Login</h2>

    <form method="POST" action="">
        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
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
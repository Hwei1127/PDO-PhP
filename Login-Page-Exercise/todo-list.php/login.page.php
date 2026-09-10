<?php

session_start();

if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] ==true){
    header('Location:index.php');
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
        header('Location:index.php');
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
<card>
    <h2>Login To Your Account</h2>

    <hr>

    <form method="POST" action="">
        <label>Email address</label>
        <input type="email" name="email" required><br><br>

        <label>Password</label>
        <input type="password" name="password" required><br><br>

        <a href="./home_page.php"><button type="submit">Login</button></a>
    </form>
</card>

<a href="./index.php">Go back</a>

</body>
</html>


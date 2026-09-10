<?php

// =====================================================
// LOGIN PAGE EXERCISE
// Follow each step. Write your code below each comment.
// =====================================================

// SETUP — Run these commands in your terminal first:

//   1. Create the database:
//      mysql -u root < db_setup.sql
//   2. Start the PHP server:
//      php -S localhost:3001

//   3. Visit in your browser:
//      http://localhost:3001/exercise.php

// =====================================================


// STEP 1: Create a connection to the database
// Use new PDO() with the following details:
//   - host: localhost
//   - database name: pdo_lesson
//   - username: root
//   - password: (empty string)
// Store the connection in a variable called $db

// YOUR CODE HERE:
    $host = 'localhost';
    $dbname = 'pdo_lesson';
    $user = 'root';
    $pass = '';

    $db = new PDO("mysql:host=$host;dbname=$dbname", $user,$pass);


// STEP 2: Display a login form
// Use echo to output an HTML form with:
//   - method="post"
//   - A text input with name="username"
//   - A password input with name="password"
//   - A submit button with name="login"

// YOUR CODE HERE:

echo '<form method="post">
    <label>Username: <input type="text" name="username" size="30"></label><br><br>
    <label>Password: <input type="password" name="password" size="30"></label><br><br>
    <input type="submit" name="login" value="Login">
</form>';


// STEP 3: Check if the form was submitted
// Use if (isset($_POST['login'])) to check if the user clicked the button

// YOUR CODE HERE:

if (isset($_POST['login'])){

// STEP 4: Get the username and password from the form
// Use $_POST['username'] and $_POST['password']
// Store them in variables called $username and $password

// YOUR CODE HERE:

    $username = $_POST['username'];
    $password = $_POST['password'];

// STEP 5: Write a prepared statement
// Use $db->prepare() with this SQL:
//   SELECT * FROM users WHERE username = :username AND password = :password
// Store it in a variable called $statement

// YOUR CODE HERE:

  $statement = $db->prepare("SELECT * FROM users WHERE username = :username AND password = :password");

// STEP 6: Execute the statement
// Use $statement->execute() and pass an array that maps:
//   ':username' => $username
//   ':password' => $password

// YOUR CODE HERE:

    $statement->execute(array(
        ':username' => $username,
        ':password' => $password
    ));

// STEP 7: Fetch the result
// Use $statement->fetch(PDO::FETCH_ASSOC) to get the row
// Store it in a variable called $user

// YOUR CODE HERE:

    $user = $statement->fetch(PDO::FETCH_ASSOC);

// STEP 8: Check if login was successful
// If $user has a value, echo "Welcome, " and the user's name
// If not, echo "Login failed."
//
// Hint: the name column is accessed with $user['name']
// Hint: wrap output in htmlspecialchars() for safety

// YOUR CODE HERE:

    if ($user) {
        echo "<p style='color:green;'Welcome " . htmlspecialchars($user['username']) . "</p>";
    } else {
        echo "<p style='color:red;'>Login failed.</p>";
    }

// STEP 9: Close the if statement from Step 3

// YOUR CODE HERE:

}
?>

<!-- // =====================================================
// TEST YOUR LOGIN PAGE
// Run: php -S localhost:3001
// Visit: http://localhost:3001/exercise.php
//
// Try these logins:
//   alice / password123    → should work
//   bob / securepass       → should work
//   alice' --  / anything  → should FAIL (that's the whole point!)
// ===================================================== -->


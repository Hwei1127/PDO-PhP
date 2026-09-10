<?php
// =====================================================
// PART 2: CRUD OPERATIONS
// =====================================================
 $host = 'localhost';
    $dbname = 'pdo_lesson';
    $user = 'root';
    $pass = '';

    $db = new PDO("mysql:host=$host;dbname=$dbname", $user,$pass);

echo "<hr>";
echo "<h1>CRUD Operations</h1>";


// STEP 10: Display all users
// Write a prepared statement to SELECT id, username, email, name FROM users
// Execute it and fetchAll(PDO::FETCH_ASSOC) into a variable called $rows
// Loop through $rows and echo each user's info

// YOUR CODE HERE:

function showUsers($db) {
    $statement = $db->prepare('SELECT id, username, email, name FROM users');
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Name</th></tr>";
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "</tr>";
    }

    echo "</table><br>";
}

// STEP 11: Insert a new user
// Use $db->prepare() with this SQL:
//   INSERT INTO users (username, email, password, name)
//   VALUES (:username, :email, :password, :name)
//
// Then execute() with an array mapping:
//   ':username' => 'frank'
//   ':email'    => 'frank@example.com'
//   ':password' => 'frankpass'
//   ':name'     => 'Frank Castle'

echo "<h2>INSERT</h2>";

// YOUR CODE HERE:

$statement = $db->prepare("INSERT INTO users (username, email, password, name) VALUES (:username, :email, :password, :name)");
$statement->execute(array(
    ':username' => 'frank',
    ':email'    => 'frank@example.com',
    ':password' => 'frankpass',
    ':name'     => 'Frank Castle'
));

// STEP 12: Display all users again to see Frank was added

// YOUR CODE HERE:

showUsers($db);

echo "<hr>";

// STEP 13: Update Frank's email
// Use $db->prepare() with this SQL:
//   UPDATE users SET email = :email WHERE username = :username
//
// Then execute() with:
//   ':email'    => 'frank.castle@example.com'
//   ':username' => 'frank'

echo "<h2>UPDATE</h2>";

// YOUR CODE HERE:

$statement = $db->prepare("UPDATE users SET email = :email WHERE username = :username");
$statement->execute(array(
    ':email'    => 'frank.castle@example.com',
    ':username' => 'frank'
));

// STEP 14: Display all users again to see Frank's email changed

// YOUR CODE HERE:

showUsers($db);

echo "<hr>";

// STEP 15: Delete Frank
// Use $db->prepare() with this SQL:
//   DELETE FROM users WHERE username = :username
//
// Then execute() with:
//   ':username' => 'frank'

echo "<h2>DELETE</h2>";

// YOUR CODE HERE:

$statement = $db->prepare("DELETE FROM users WHERE username = :username");
$statement->execute(array(':username' => 'frank'));


// STEP 16: Display all users one last time to see Frank is gone

// YOUR CODE HERE:

showUsers($db);

// =====================================================
// PART 3: ERROR HANDLING
// =====================================================

echo "<hr>";
echo "<h1>Error Handling</h1>";


// STEP 17: Try a bad query WITH try/catch
// Wrap the following inside a try/catch block:
//   - Prepare this SQL: SELECT * FROM nonexistent_table
//   - Execute it
//
// In the catch block:
//   - Echo a friendly error message
//   - Use $e->getMessage() to show what went wrong
//
// Hint:
//   try {
//       // your code
//   } catch (PDOException $e) {
//       // echo error
//   }

echo "<h2>Bad query (with try/catch)</h2>";

// YOUR CODE HERE:

try {
    $db = new PDO("mysql:host=localhost;dbname=pdo_lesson", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $db->prepare("SELECT * FROM nonexistent_table");
    $statement->execute();

} catch (PDOException $e) {
    echo "<p style='color:red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}

echo "<hr>";

// STEP 18: Try a good query WITH try/catch
// Inside try:
//   - Prepare: SELECT username, name FROM users LIMIT 3
//   - Execute and fetchAll
//   - Loop through results and echo each user's name and username
//
// Inside catch:
//   - Echo the error message

echo "<h2>Good query (with try/catch)</h2>";

// YOUR CODE HERE:
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

?>
<!-- // =====================================================
// TEST YOUR FULL PAGE
// Run: php -S localhost:3001
// Visit: http://localhost:3001/exercise.php
//
// You should see:
//   - Your login form working
//   - Users listed, Frank inserted, updated, then deleted
//   - A friendly error for the bad query
//   - A list of 3 users for the good query
//
// Hint: Run db_setup.sql again in Workbench to reset the data
// ===================================================== -->
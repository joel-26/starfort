<?php
session_start();  // Start the session

// Database connection settings
$host = 'mysql.pdmoo.dreamhosters.com';  // Database host
$dbname = 'starfort_email_client';  // Database name
$db_username = 'starfortadmin';  // Database username
$db_password = 'Starfortm@2000';  // Database password

// Create a PDO instance for database connection
$dsn = "mysql:host=$host;dbname=$dbname";
try {
    $pdo = new PDO($dsn, $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection errors
    die("Could not connect to the database: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Query to check if user exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $input_username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($input_password, $user['password'])) {
        // If authentication is successful, start a session
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $input_username;  // Store username in session

        // Redirect to the email client page
        header("Location: email_client.php");
        exit();
    } else {
        // If authentication fails, redirect to the error page with a message
        header("Location: invalid_credentials.php?message=" . urlencode("Invalid username or password"));
        exit();
    }
}
?>

<?php
$servername = "mysql.pdmoo.dreamhosters.com"; // or your database host
$username = "starfortadmin";
$password = "Starfortm@2000";
$database = "starfort_email_client";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

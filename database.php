<?php
$host = 'localhost';          // Database host
$dbname = 'library_management'; // Name of the database
$username = 'root';           // Database username (default for XAMPP/WAMP)
$password = '';               // Database password (default is empty for XAMPP/WAMP)

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

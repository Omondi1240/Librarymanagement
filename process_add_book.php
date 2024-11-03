<?php
require 'database.php'; // Include database connection

// Get data from the form
$title = $_POST['title'];
$author = $_POST['author'];
$genre = $_POST['genre'];
$year = $_POST['year'];

// Insert data into the database
$sql = "INSERT INTO books (title, author, genre, year_published) VALUES ('$title', '$author', '$genre', '$year')";

if ($conn->query($sql) === TRUE) {
    echo "New book added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close(); // Close connection
?>

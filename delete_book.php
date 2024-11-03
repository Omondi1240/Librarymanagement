<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookId = intval($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM books WHERE book_id = ?");
    $stmt->bind_param("i", $bookId);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
    $stmt->close();
    $conn->close();
}
?>

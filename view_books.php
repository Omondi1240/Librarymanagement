<?php
// Include database connection
include 'database.php';

// Query to select all books
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books - Library Management System</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to an optional CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery for AJAX -->
    <style>
        /* Inline CSS for quick customization */
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; margin: 0; padding: 0; }
        .header, .footer { background-color: maroon; color: white; padding: 20px; text-align: center; }
        .header img { height: 50px; vertical-align: middle; }
        .container { width: 80%; margin: 20px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #a52a2a; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .action-icons { display: flex; gap: 10px; }
        .action-icons a { color: #800000; cursor: pointer; }
    </style>
</head>
<body>

<!-- Header -->
<?php include 'includes/header.php' ?>
<div class="" style="padding: 10px 150px;">
<a href="add_book.php" style="color:black;"><i class='fas fa-plus' style="padding:0px 10px"></i>Add Book</a>
</div>

<div class="container">
    <h2>Book List</h2>

    <table id="bookTable">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Year</th>
            <th>Reference</th>
            <th>Actions</th>
        </tr>

        <?php
        // Check if there are records
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr id='book_" . htmlspecialchars($row['book_id']) . "'>";
                echo "<td>" . htmlspecialchars($row['book_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                echo "<td>" . htmlspecialchars($row['author']) . "</td>";
                echo "<td>" . htmlspecialchars($row['genre']) . "</td>";
                echo "<td>" . htmlspecialchars($row['year_published']) . "</td>";
                echo "<td>" . htmlspecialchars($row['isbn']) . "</td>";
                echo "<td class='action-icons'>"
                    . "<a onclick='deleteBook(" . htmlspecialchars($row['book_id']) . ")'>"
                    . "<i class='fas fa-trash'></i></a>"
                    . "<a href='update_book.php?id=" . htmlspecialchars($row['book_id']) . "'>"
                    . "<i class='fas fa-edit'></i></a>"
                    . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No books found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</div>

<!-- Footer -->
<?php include 'includes/footer.php' ?>

<script>
    function deleteBook(bookId) {
        if (confirm('Are you sure you want to delete this book?')) {
            $.ajax({
                url: 'delete_book.php',
                type: 'POST',
                data: { id: bookId },
                success: function(response) {
                    if (response == 'success') {
                        $('#book_' + bookId).remove();
                        alert('Book deleted successfully.');
                    } else {
                        alert('Error deleting book. Please try again.');
                    }
                },
                error: function() {
                    alert('Error with the request. Please try again.');
                }
            });
        }
    }
</script>

</body>
</html>

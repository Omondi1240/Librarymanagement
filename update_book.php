<?php
// Include database connection
include 'database.php';

// Get the book ID from the URL
$book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the book details
$sql = "SELECT * FROM books WHERE book_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if (!$book) {
    echo "Book not found.";
    exit;
}

// Handle form submission for updating the book details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $year_published = $_POST['year_published'];

    $update_sql = "UPDATE books SET title = ?, author = ?, genre = ?, year_published = ? WHERE book_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssii", $title, $author, $genre, $year_published, $book_id);
    
    if ($update_stmt->execute()) {
        echo "Book updated successfully.";
        // Redirect back to the book list or display a success message
        header("Location: view_books.php");
        exit;
    } else {
        echo "Error updating book.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book - Library Management System</title>
</head>
<style>
    .container {
            width: 50%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            flex: 1;
        }
    label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #800000; 
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #A0522D;
        }
</style>
<body>
<?php include 'includes/header.php' ?>
    <div class="container">
    <form action="update_book.php?id=<?php echo $book_id; ?>" method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required><br>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required><br>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($book['genre']); ?>" required><br>

        <label for="year_published">Year Published:</label>
        <input type="number" id="year_published" name="year_published" value="<?php echo htmlspecialchars($book['year_published']); ?>" required><br>

        <button type="submit">Update Book</button>
    </form>
    </div>
    <?php include 'includes/footer.php' ?>
</body>
</html>

<?php
require 'database.php';

$message = ''; // Variable to hold the success/error message

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];

    // Prepare and execute the insert query
    $sql = "INSERT INTO books (title, author, genre, year_published) VALUES ('$title', '$author', '$genre', '$year')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "New book added successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
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
        .main-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .main-header img {
            height: 60px;
            width: 60px;
            margin-right: 10px;
            object-fit: cover;
        }
        .main-header h2 {
            margin: 0;
            color: #800000;
            font-size: 24px;
        }
        .sub-header {
            text-align: center;
            font-size: 18px;
            color: #800000;
            margin-bottom: 20px;
            font-weight: bold;
        }
        h1 {
            text-align: center;
            color: #800000;
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
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #800000;
            color: #fff;
            font-size: 14px;
            margin-top: 20px;
        }
        .footer p {
            margin: 4px 0;
        }
        .message {
            color: green; 
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<?php include 'includes/header.php' ?>


    <div class="container">
        <h1>Add New Book</h1>
        
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>

            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" required>

            <label for="year">Year:</label>
            <input type="number" id="year" name="year" required>

            <input type="submit" value="Add Book">
        </form>
        <a href="view_books.php" style="display: block; text-align: center; margin-top: 20px;">View All Books</a>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p><strong>Group E</strong></p>
        <p>DBITNRB609824 - DERRICK OMONDI OTIENO</p>
        <p>DBITNRB333824 - MARTIN NJOROGE</p>
        <p>DBITNRB548822 - GRACE LUCAS</p>
        <p>DBITLMR346824 - CYNTHIA MWANGI</p>
    </div>

</body>
</html>

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit a Review</title>
</head>
<body>
    <h1>Submit a Review</h1>
    <form method="post" action="submitComment.php">
        <label for="product">Select Product:</label>
        <select id="product" name="product" required>
            <?php
            include('include/project_config.php');

            // Fetch products from database
            $query = "SELECT name FROM products";
            $result = $sql->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $productName = $row['name'];
                    echo "<option value='$productName'>$productName</option>";
                }
            } else {
                echo "<option value='' disabled>No products available</option>";
            }
            ?>
        </select><br>
        <label for="username">Your Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="comment">Your Comment:</label><br>
        <textarea id="comment" name="comment" rows="4" cols="50" required></textarea><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
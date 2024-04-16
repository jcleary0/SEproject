<?php
session_start();

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$db = "product_rating_analysis";
$sql = mysqli_connect($host, $username, $password, $db);
if ($sql->connect_error) {
    die("Connection failed: " . $sql->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Rating System</title>
    <style>
        /* Your existing CSS styles */
    </style>
</head>
<body>
<header>
    <img src="logo.png" alt="Logo" class="logo">
    <h1>Welcome to Product Rating System</h1>
    <a href="account.html" class="account-link">My Account</a>
</header>
<main>
    <div class="container">
        <div class="search-bar">
            <form method="post" action="search_results.php">
                <input type="text" name="searchterm" placeholder="Search term">
                <button type="submit" class="btn">Search</button>
            </form>
        </div>

        <p>Rate and review your favorite products to help others make informed decisions.</p>
        <a href="submit.php" class="btn">Submit a Review</a>
    </div>

    <?php
    // Query to fetch products
    $query = "SELECT id, name, description FROM products";
    $result = $sql->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='container'>";
            echo "<strong><br />Product ID: </strong>";
            echo stripslashes($row['id']);
            echo "<br />Product Name: ";
            echo stripslashes($row['name']);
            echo "<br />Product Description: ";
            echo stripslashes($row['description']);

            // Display comments for this product
            echo "<br /><strong>Comments:</strong><br />";
            $product_id = $row['id'];
            $comments_query = "SELECT user_id, comment FROM comments WHERE product_id = $product_id";
            $comments_result = $sql->query($comments_query);

            if ($comments_result->num_rows > 0) {
                while ($comment_row = $comments_result->fetch_assoc()) {
                    $user_id = $comment_row['user_id'];
                    $comment = stripslashes($comment_row['comment']);

                    // Display username (assuming you have a users table)
                    $username_query = "SELECT username FROM users WHERE id = $user_id";
                    $username_result = $sql->query($username_query);
                    $username_row = $username_result->fetch_assoc();
                    $username = stripslashes($username_row['username']);

                    echo "<strong>$username:</strong> $comment<br />";
                }
            } else {
                echo "No comments yet.";
            }

            // Add form to submit a new comment
            if(isset($_SESSION['user_id'])) {
                echo "<form method='post' action='submitComment.php'>";
                echo "<input type='hidden' name='product_id' value='$product_id'>";
                echo "<textarea name='comment' placeholder='Write your comment'></textarea><br />";
                echo "<button type='submit'>Submit Comment</button>";
                echo "</form>";
            } else {
                echo "<p>Please <a href='userLogin.html'>login</a> to leave a comment.</p>";
            }

            echo "</div>"; // Closing container div
        }
    } else {
        echo "0 results";
    }
    ?>
</main>
</body>
</html>

<?php
// Close database connection
$sql->close();
?>
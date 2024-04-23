<?php
session_start();
include('include/project_config.php');

// Retrieve form data
$product = $_POST['product'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

// Ensure that the product name is properly escaped and sanitized
$productName = mysqli_real_escape_string($sql, $product);

// Check if the table for the product exists
$tableExistsQuery = "SHOW TABLES LIKE '$productName'";
$tableExistsResult = $sql->query($tableExistsQuery);

if ($tableExistsResult->num_rows > 0) {
    // Table exists, insert rating and comment into the corresponding product table
    $insertQuery = "INSERT INTO `$productName` (rating, comment) VALUES (?, ?)";
    $insertStmt = $sql->prepare($insertQuery);

    if (!$insertStmt) {
        // Handle the error if the prepare statement fails
        echo "Error preparing statement: " . $sql->error;
    } else {
        // Bind parameters to the statement
        $insertStmt->bind_param("ss", $rating, $comment);

        // Execute the statement
        if ($insertStmt->execute()) {
            // Calculate average rating
            $averageRatingQuery = "SELECT AVG(rating) AS averageRating FROM `$productName`";
            $averageRatingResult = $sql->query($averageRatingQuery);

            if ($averageRatingResult) {
                $averageRatingRow = $averageRatingResult->fetch_assoc();
                $averageRating = $averageRatingRow['averageRating'];

                // Update product rating in the products table
                $updateProductQuery = "UPDATE products SET rating = ? WHERE name = ?";
                $updateProductStmt = $sql->prepare($updateProductQuery);

                if (!$updateProductStmt) {
                    echo "Error preparing update statement: " . $sql->error;
                } else {
                    // Bind parameters to the statement
                    $updateProductStmt->bind_param("ss", $averageRating, $productName);

                    // Execute the statement
                    if (!$updateProductStmt->execute()) {
                        echo "Error updating product rating: " . $updateProductStmt->error;
                    }
                }
            } else {
                echo "Error calculating average rating: " . $sql->error;
            }

            // Redirect to userHomepage.php
            header("Location: userHomepage.php");
            exit();
        } else {
            // Handle the error if the execution fails
            echo "Error executing statement: " . $insertStmt->error;
        }
    }
} else {
    echo "Error: Table for product '$productName' does not exist.";
}

// Close connection
$sql->close();
?>

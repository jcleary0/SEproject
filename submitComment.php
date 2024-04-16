<?php
session_start();
include('include/project_config.php');

// Retrieve form data
$product = $_POST['product'];
$username = $_POST['username'];
$comment = $_POST['comment'];

// Insert comment into the corresponding table
$insertQuery = "INSERT INTO $product (user_id, comment) VALUES (?, ?)";
$insertStmt = $sql->prepare($insertQuery);
$insertStmt->bind_param("ss", $username, $comment); // Bind the username and comment parameters

if ($insertStmt->execute()) {
    echo "Comment submitted successfully";
} else {
    echo "Error submitting comment: " . $insertStmt->error;
}

// Close connection
$sql->close();
?>
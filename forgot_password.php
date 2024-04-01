<?php
// Database connection
session_start();
include('include/project_config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    
    // Check if email exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Update the user's password in the database
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql_update = "UPDATE users SET password = '$hashed_password' WHERE username = '$username'";

        if ($conn->query($sql_update) === TRUE) {
            echo "Your password has been reset successfully.";
        } else {
            echo "Error updating password: " . $conn->error;
        }
        }
            // Redirect user to login page after password reset
            header("Location: login.php");
            exit;
    } else {
        echo "No user found with that email address.";
    }

$conn->close();
?>

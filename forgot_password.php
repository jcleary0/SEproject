<?php
// Database connection
$servername = "localhost";
$username = "product";
$password = "analysis";
$dbname = "ProductAnalysis.SQL";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    
    // Check if email exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Generate a new random password
        $new_password = bin2hex(random_bytes(8)); // Generate an 8-character random password
        
        // Update the user's password in the database
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql_update = "UPDATE users SET password = '$hashed_password' WHERE email = '$email'";
        if ($conn->query($sql_update) === TRUE) {
            // Send the new password to the user's email 
            $message = "Your new password is: " . $new_password;
             
            echo "Your password has been reset. Please check your email.";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "No user found with that email address.";
    }
}

$conn->close();
?>

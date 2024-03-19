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
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Check if username or email already exists in the database
    $sql_check = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "Username or email already exists. Please choose a different one.";
    } else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert the new user into the database
        $sql_insert = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if ($conn->query($sql_insert) === TRUE) {
            echo "You have successfully signed up!";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

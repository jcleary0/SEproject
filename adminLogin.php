<?php
session_start();

// Include the database configuration
include('include/project_config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if the username and password exist in the database
    $query = "SELECT * FROM admin WHERE username = ? AND password = ?";
    $stmt = $sql->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if a row is returned (i.e., if the login is successful)
    if ($result->num_rows == 1) {
        // Set session variables
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        
        // Redirect to adminHomepage.php
        header("Location: adminHomepage.php");
        exit(); // Prevent further execution
    } else {
        // Authentication failed, display error message
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Ranking - Home</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to CSS file used for more specific design -->
</head>

<body>
    <div class="container">
        <h1>Product Ranking</h1>
	<h2>Admin Login</h2>

        <!-- image or logo above the login form -->
        <img src="img/mockup.jpg" alt="Logo" class="logo">

         <!-- adding space between image and login -->
         <div class="space"></div>

        <!-- login form -->
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>
            
            <label for="password">Password:</label>
            <input type="password" name="password" required><br>
            
            <input type="submit" value="Login">
            <a href="forgot_password.php">Forgot Password?</a>
        </form>

    </div>
</body>

</html>

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
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif, sans-serif;
            background-color: #e3eaea; 
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
           
            width: 60%; 
            height: 80vh; 
            padding: 20px;
            background: linear-gradient(135deg, #aebaba, #869296); 
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h2 {
            color: #333;
            font-size: 24px; 
            font-weight: bold; 
            text-transform: uppercase; 
            text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
        }

        .logo {
            /* logo size */
            max-width: 40%; 
            height: 40%; 
            margin-top: 10px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Welcome to Mood Matrix</h2>
<h2>Admin Login</h2>

        <!-- image or logo above the login form -->
        <img src="logo.png" alt="Logo" class="logo">

         <!-- adding space between image and login -->
         <div class="space"></div>

        <!-- login form -->
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>
            
            <label for="password">Password: </label>
            <input type="password" name="password" required><br>
            
            <input type="submit" value="Login">
            </form>
    </div>
</body>
</html>

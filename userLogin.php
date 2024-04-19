<?php
require'product_config.php';
if(!empty($_SESSION["id"])){
    header("Location: index.php");
}
if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result =mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    
    if ($result && mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $hashedpassword = $row["password"];

    if(password_verify($password, $hashedpassword)){
            session_start();
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: index.php");
            exit();
        }
        else{
            echo
        "<script> alert('Wrong Password'); </script>";
        }
    }
    else{
        echo
        "<script> alert('User not Registered'); </script>";
    }
}
?>
<!--Product Ranking Website Index File-->
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
        <h2>Welcome to Product Ranking</h2>

        <!-- image or logo above the login form -->
        <img src="logo.png" alt="Logo" class="logo">

         <!-- adding space between image and login -->
         <div class="space"></div>

        <!-- login form -->
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id = "username" required><br>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id = "password" required><br>
            
            <button type="submit" name="submit">Login</button>
            <a href="forgot_password.php">Forgot Password?</a>
        </form>
        <!-- signup link -->
        <p>Don't have an account? <a href="signup.php">Sign up!</a></p>

	<!-- admin link -->
        <p>Need admin login? <a href="adminLogin.php">Click here!</a></p>
    </div>
</body>

</html>

<?php
require'config.php';
if(!empty($_SESSION["id"])){
    header("Location: index.php");
}
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
    if (!$duplicate) {
        die('Error: ' . mysqli_error($conn)); // Handle database query error
    }
    if(mysqli_num_rows($duplicate) > 0){
        echo
        "<script> alert('Username or Email is already taken'); </script>";
    }
    else{
        if($password == $confirmpassword){
            // Hash the password before storing it in the database
            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (name, username, password, email) VALUES('$name', '$username', '$hashedpassword', '$email')";
            $result = mysqli_query($conn,$query);
        mysqli_query($conn, $query);
            if (!$result) {
                die('Error: ' . mysqli_error($conn)); // Handle database query error
            }
            echo
        "<script> alert('Registration Sucessful'); </script>";
        }
        else{
            echo
        "<script> alert('Password does not match'); </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
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
            background: linear-gradient(135deg, #d1cdcd, #ada8a2);
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

        .Logo {
            max-width: 40%;
            height: 40%;
            margin-top: 10px;
            border-radius: 8px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Sign up to use Mood Matrix!</h2>

    <img src="logo.png" alt="Logo" class="Logo">

    <form class="" action="" method= "post" autocomplete="off">
        <label for="name">Name : </label>
        <input type="text" name="name" id= "name" required value=""> <br>
        
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="confirmpassword">Confirm Password : </label>
        <input type="password" name="confirmpassword" id= "confirmpassword" required value=""> <br>

        <input type="submit" name="submit" value="Submit">
       
    </form>
   
    <p>Already have an account? <a href="userLogin.php">log in!</a></p>
</div>
</body>
</html>
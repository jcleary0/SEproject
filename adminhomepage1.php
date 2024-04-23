<?php include('include/project_config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Matrix</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif, sans-serif;
            background-color: #e3eaea;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center; /* Center align all text */
        }
        
        .container {
            width: 60%;
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
            margin-bottom: 20px; /* Add some space below the title */
        }

        .logo {
            max-width: 40%;
            height: 40%;
            margin-top: 10px; /* Add some space at the top */
            border-radius: 8px;
            position: absolute; /* Position the logo absolutely */
            top: 10px; /* Align the logo to the top */
            left: 10px; /* Align the logo to the left */
        }

        /* Add some space between the "Add Product" section and the title */
        form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Admin Homepage</h2>
    <img src="logo.png" alt="Logo" class="logo">

<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        // Redirect to login if session variables are not set
        header("Location: adminLogin.php");
        exit();
    }

    // Retrieve username and password from session
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    // Query to retrieve products
    $query = "SELECT * FROM products";
    $result = mysqli_query($sql, $query);

    // Check if query executed successfully
    if (!$result) {
        echo "Error: " . mysqli_error($sql);
    } else {
        // Display products
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['name'];
            $description = $row['description'];
            
            echo "<h1>Product Name: $name</h1>";
            echo "<p> Product ID: $id</p>";
            echo "<p> Product Description: $description</p>";
            
            // Allows admin to change product info, connected to update_product.php
            echo "<form method='post' action='update_product.php'>";
            echo "<input type='hidden' name='id' value='$id' />";
            echo "<input type='text' name='name' value='$name' />";
            echo "<input type='text' name='description' value='$description' />";
            echo "<input type='submit' value='Update Product' />";
            echo "</form>";
            
            // Delete item button for admin use, connected to delete_product.php
            echo "<form method='post' action='delete_product.php'>";
            echo "<input type='hidden' name='id' value='$id' />";
            echo "<input type='submit' value='Delete Product' />";
            echo "</form>";
            
            echo "</p>";
        }
    }
?>

<!-- Add item for admin use, which goes to add_product.php -->
    <h2>Add Product</h2>
    <form method="post" action="add_product.php">
        <label for="name">Product Name:</label>
        <input type="varchar" id="name" name="name" required><br>
        <label for="description">Product Description:</label>
        <input type="text" id="description" name="description" required><br>
        <input type="submit" value="Add Product">
    </form>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Rating System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        main {
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            font-size: 2em;
            margin-bottom: 20px;
            text-align: center;
        }
        p {
            margin-bottom: 20px;
        }
        .search-bar {
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 300px;
        }
        .btn {
            display: inline-block;
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        }
        .btn:hover {
            background-color: #555;
        }
        .account-link {
            color: #fff;
            text-decoration: none;
        }
        .logo {
            max-width: 100px;
            height: auto;
            margin-left: 20px;
        }
    </style>
</head>
<body>
<header>
    <img src="logo.png" alt="Logo" class="logo">
    <h1>Welcome to Product Rating System</h1>
    <a href="account.html" class="account-link">My Account</a>
</header>
<main>
    <div class="container">
        <div class="search-bar">
            <form method="post" action="search_results.php">
                <input type="text" name="searchterm" placeholder="Search term">
                <button type="submit" class="btn">Search</button>
            </form>
        </div>

        <p>Rate and review your favorite products to help others make informed decisions.</p>
        <a href="submit.html" class="btn">Submit a Review</a>
    </div>

<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "product_rating_analysis";
$sql = mysqli_connect($host, $username, $password, $db);
if ($sql->connect_error) {
    die("Connection failed: " . $sql->connect_error);
}

// SQL query
$query = "SELECT id, name, description FROM products";
$result = $sql->query($query);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<strong><br />Product ID: </strong>";
        echo stripslashes($row['id']);
        echo "<br />Product Name: ";
        echo stripslashes($row['name']);
        echo "<br />Product Description: ";
        echo stripslashes($row['description']);
    }
} else {
    echo "0 results";
}
$sql->close();
?>
</main>
</body>
</html>

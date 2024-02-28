<html>
<head>
  <title>Mood Matrix</title>
</head>

<body>
<h1>Admin Page</h1>
<h2>Edit products, add/remove products</h2>

<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "product_rating_analysis";
$sql = mysqli_connect($host, $username, $password, $db);
if ($sql->connect_error) {
  die("Connection failed: " . $sql->connect_error);
}

  //SQL query
  $query = "SELECT id, name, description FROM products";
  $result = $sql->query($query);

  $num_results = $result->num_rows;

  //For loop to display the items in our DB table
  for ($i=0; $i <$num_results; $i++) {
     $row = $result->fetch_assoc();
     echo "</strong><br />Product ID: ";
     echo stripslashes($row['id']);
     echo "<br />Product Name: ";
     echo stripslashes($row['name']);
     echo "<br />Product Description: ";
     echo stripslashes($row['description']);
     
     //Allows admin to change product info, connected to update_product.php
     echo "<form method='post' action='update_product.php'>";
     echo "<input type='int' name='id' value='" . $row['id'] . "' />";
     echo "<input type='varchar' name='name' value='" . $row['name'] . "' />";
     echo "<input type='text' name='description' value='" . $row['description'] . "'  />";
     echo "<input type='submit' value='Update Product' />";
     echo "</form>";
     
     
     //Delete item button for admin use, connected to delete_product.php
     echo "<form method='post' action='delete_product.php'>";
     echo "<input type='hidden' name='id' value='" . $row['id'] . "' />";
     echo "<input type='submit' value='Delete Product' />";
     echo "</form>";
     
     echo "</p>";
  }

  $result->free();
  $sql->close();

?>

<!-- Add item, which goes to add_product.php -->
<h2>Add Product</h2>
<form method="post" action="add_product.php">
  <label for="id">Product ID:</label>
  <input type="int" id="id" name="id" required><br>
  <label for="name">Product Name:</label>
  <input type="varchar" id="name" name="name" required><br>
  <label for="description">Product Description:</label>
  <input type="text" id="description" name="description" required><br>
  <input type="submit" value="Add Product">
</form>

</body>
</html>

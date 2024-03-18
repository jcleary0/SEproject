<?php include('include/project_config.php'); ?>
<html>
<head>
  <title>Mood Matrix</title>
</head>

<body>
<h1>Admin Homepage</h1>
<h2>Edit, add, and remove products</h2>

<?php
$query = mysqli_query($sql, "SELECT * FROM products");
while($row = mysqli_fetch_assoc($query))
{
    $id = $row['id'];
    $name = $row['name'];
    $description = $row['description'];
    
    echo "<h1>Product Name: $name</h1>";
    echo "<p> Product ID: $id</p>";
    echo "<p> Product Description: $description</p>";
    
    //Allows admin to change product info, connected to update_product.php
    echo "<form method='post' action='update_product.php'>";
    echo "<input type='hidden' name='id' value='$id' />";
    echo "<input type='text' name='name' value='$name' />";
    echo "<input type='text' name='description' value='$description' />";
    echo "<input type='submit' value='Update Product' />";
    echo "</form>";
    
    
    //Delete item button for admin use, connected to delete_product.php
    echo "<form method='post' action='delete_product.php'>";
    echo "<input type='hidden' name='id' value='$id' />";
    echo "<input type='submit' value='Delete Product' />";
    echo "</form>";
    
    echo "</p>";
}
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

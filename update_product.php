<?php 
include('include/project_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve product data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id = $_POST['id'];

    // SQL query
    $query = "UPDATE products SET name = ?, description = ? WHERE id = ?";
    $stmt = $sql->prepare($query);

    if (!$stmt) {
        echo "Error: " . $sql->error;
    }

    // Bind parameters
    $stmt->bind_param("ssi", $name, $description, $id);

    // SQL update query
    if ($stmt->execute()) {
        echo "Product updated successfully!";
    } else {
        echo "Failed to update product.";
    }
    $stmt->close();
    $sql->close();
}
?>

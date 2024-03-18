<?php 
include('include/project_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id = $_POST['id'];

    // Prepare SQL query
    $query = "UPDATE products SET name = ?, description = ? WHERE id = ?";
    $stmt = $sql->prepare($query);

    if (!$stmt) {
        echo "Error preparing statement: " . $sql->error;
    }

    // Bind parameters
    $stmt->bind_param("ssi", $name, $description, $id);

    // Execute the SQL update query
    if ($stmt->execute()) {
        // Product updated successfully
        echo "Product updated successfully!";
    } else {
        // Failed to update product
        echo "Failed to update product.";
    }

    // Close statement and connection
    $stmt->close();
    $sql->close();
}
?>

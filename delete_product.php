<?php 
include('include/project_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve deleted product data
    $id = $_POST['id'];

    // SQL query
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $sql->prepare($query);

    if (!$stmt) {
        echo "Error: " . $sql->error;
    }

    $stmt->bind_param("i", $id);

    // SQL delete query
    if ($stmt->execute()) {
        // Product deleted
        echo "Product has been removed successfully.";
    } else {
        // Error occurred, product not deleted
        echo "Error occurred, could not remove product";
    }

    $stmt->close();
    $sql->close();
}
?>

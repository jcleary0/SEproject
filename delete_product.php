<?php 
include('include/project_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];

    // Prepare SQL query
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $sql->prepare($query);

    if (!$stmt) {
        echo "Error preparing statement: " . $sql->error;
    }

    $stmt->bind_param("i", $id);

    // Perform the SQL delete query
    if ($stmt->execute()) {
        // Item deleted
        echo "Product has been removed successfully.";
    } else {
        // Error occurred, product not deleted
        echo "Error occurred, could not remove product";
    }

    $stmt->close();
    $sql->close();
}
?>

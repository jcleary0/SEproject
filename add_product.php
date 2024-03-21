<?php
include('include/project_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve add product data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    // SQL query
    $query = "INSERT INTO products (id, name, description) VALUES (?, ?, ?)";
    $stmt = $sql->prepare($query);

    if (!$stmt) {
        echo "Error: " . $sql->error;
    } else {
        // Bind parameters to statement
        $stmt->bind_param("iss", $id, $name, $description);

        // SQL insert query
        if ($stmt->execute()) {
            // Item added
            echo "Product added successfully.";
        } else {
            echo "Error occurred, could not add product.";
        }

        $stmt->close();
    }
} else {
    echo "Error";
}

$sql->close();
?>

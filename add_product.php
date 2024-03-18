<?php
include('include/project_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Prepare SQL query
    $query = "INSERT INTO products (id, name, description) VALUES (?, ?, ?)";
    $stmt = $sql->prepare($query);

    if (!$stmt) {
        echo "Error preparing statement: " . $sql->error;
    } else {
        // Bind the parameters to the statement
        $stmt->bind_param("iss", $id, $name, $description);

        // Perform the SQL insert query
        if ($stmt->execute()) {
            // Item added
            echo "Product added successfully.";
        } else {
            // Error occurred, item not added
            echo "Error occurred, could not add product.";
        }

        $stmt->close();
    }
} else {
    // Else statement for error if SQL is not complete
    echo "Error: Could not complete statement.";
}

$sql->close();
?>

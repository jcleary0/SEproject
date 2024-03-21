<?php
include('include/project_config.php');

// Check if search is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get search term from form submission
    $search = $_POST['search'];

    // Prepare SQL statement
    $stmt = $sql->prepare("SELECT id, name, description FROM products WHERE id LIKE ? OR name LIKE ? OR description LIKE ?");

    // Check if statement was prepared successfully
    if ($stmt) {
        // Bind parameters and execute query
        $search = "%" . $search . "%";
        $stmt->bind_param("sss", $search, $search, $search);
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        // Display search results
        if ($result->num_rows > 0) {
            echo "<div class='container'>";
            echo "<h2>Search Results</h2>";
            while ($row = $result->fetch_assoc()) {
                echo "<p><strong>Product ID: " . $row['id'] . "</strong><br />";
                echo "Product Name: " . $row['name'] . "<br />";
                echo "Product Description: " . $row['description'] . "</p>";
            }
            echo "</div>";
        } else {
            echo "<p>No results found.</p>";
        }
        $result->free();
        $stmt->close();
    } else {
        echo "Error";
    }
}
?>

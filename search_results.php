<?php
// Include project configuration file
include('include/project_config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get search term from form submission
    $searchterm = $_POST['searchterm'];

    // Prepare SQL statement
    $stmt = $sql->prepare("SELECT id, name, description FROM products WHERE id LIKE ? OR name LIKE ? OR description LIKE ?");

    // Check if statement was prepared successfully
    if ($stmt) {
        // Bind parameters and execute query
        $searchterm = "%" . $searchterm . "%";
        $stmt->bind_param("sss", $searchterm, $searchterm, $searchterm);
        $stmt->execute();

        // Get result set
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

        // Close result set
        $result->free();

        // Close statement
        $stmt->close();
    } else {
        // Handle statement preparation error
        echo "Error: Unable to prepare SQL statement.";
    }
}
?>

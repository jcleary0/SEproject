<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find what you're looking for</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            display:flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            background-color: #adc4c2;
            color: #000000;
            padding: 20px;
            text-align: center;
            background-image: linear-gradient(to bottom right, #a8bdbc, #7a8d93);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            height: 150px; 
            z-index: 2; 
        }

        .logo {
            width: 150px;
            height: 150px;
            margin-right: auto;
            margin-left: 20px;
        }

        .header-text {
            position: absolute; 
            top: 50px; 
            left: 50%; 
            transform: translateX(-50%); 
            color: #ffffff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 0;
            text-align: center;
            width: 100%;
        }

        .subheading {
            position: absolute; 
            bottom: 50px; 
            left: 50%; 
            transform: translateX(-50%); 
            color: #6e3514;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 0;
            text-align: center;
            width: 100%;
        }

        .panel {
            position: fixed;
            top: 190px; 
            left: 0;
            bottom: 0;
            width: 195px;
            background-color: #adc4c2;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-image: linear-gradient(to bottom right, #a8bdbc, #7a8d93);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            padding-top: 20px;
            z-index: 1;
        }

        .categories {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }

        .category-card {
            margin-bottom: 10px;
            padding: 10px 20px;
            background-image: linear-gradient(to bottom right, #d8d6d6, #b5b5b5);
            color: #000000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-image 0.3s ease;
        }

        .category-card:hover {
            background-image: linear-gradient(to bottom right, #7a8d93, #a8bdbc);
        }

        .search-bar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin: 20px;
            margin-left: 1000px;
            width: 30%;
        }

        input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            flex: 1;
        }

        button {
            padding: 10px 20px;
            background-image: linear-gradient(to bottom right, #d8d6d6, #b5b5b5);
            color: #000000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-image 0.3s ease;
        }

        button:hover {
            background-image: linear-gradient(to bottom right, #7a8d93, #a8bdbc);
        }

        .popular-products {
            text-align: center;
            margin-top: 50px;
        }
        .product-grid {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 20px 0;
}

.row {
    display: flex;
    justify-content: space-around; 
    margin-bottom: 10px;
    width: 100%; 
}

.column {
    width: 45%;
    height: auto; 
    margin: 0 5px; 
    border-radius: 5px;
    border: 1px solid #ccc; 
    padding: 10px; 
}
        .product-image {
            width: 150px;
            height: 150px;
            margin: 10px;
            border-radius: 5px;
        }

        .product { 
        display: flex; 
        flex-wrap: wrap; 
        justify-content: space-around;
        }

        .account-link {
            position: absolute;
            top: 20px;
            right: 50px;
            color: rgb(0, 0, 0);
            text-decoration: underline;
            cursor: pointer;
        }
        

    </style>
</head>
<body>

    <header>
        <img src="logo.png" alt="Logo" class="logo">
        <div>
            <h1 class="header-text">Products reviewed by people like you!</h1>
            <h2 class="subheading">Find what you're looking for.</h2>
        </div>
    </header>

    <div class="panel">
        <div class="panel-heading">Categories</div>
        <div class="categories">
            <div class="category-card" onclick="showCategory('accessories')">Accessories</div>
            <div class="category-card" onclick="showCategory('appliances')">Appliances</div>
            <div class="category-card" onclick="showCategory('electronics')">Electronics</div>
            <div class="category-card" onclick="showCategory('home decor')">Home Decor</div>
            <!-- Add more categories -->
        </div>
    </div>

    <section>

        <div class="search-bar">
            <form method="post" action="search_results.php">
                <input type="text" name="searchterm" placeholder="Search term">
                <button type="submit" class="btn">Search</button>
            </form>
        </div>

        <a href="submit.php" class="btn">Submit a Review</a>

        <div class="popular-products">
    <h2>Popular Products</h2>
    <h3>~~~~~~~~~~~~~~~~</h3>
    <div class="product-grid">
        <?php
	include('include/project_config.php');
        $query = "SELECT p.id, p.name, p.description, p.category, p.rating FROM products p";
        $result = mysqli_query($sql, $query);

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = stripslashes($row['name']);
                $description = stripslashes($row['description']);
                $category = stripslashes($row['category']);
                $rating = stripslashes($row['rating']);

                echo "<div class='row'>";
                echo "<div class='column'>";
                echo "<h3>Product Name: $name</h3>";
                echo "<p>Product Description: $description</p>";
                echo "<p>Product Category: $category</p>";
                echo "<p>Product Rating: $rating</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No products found.</p>";
        }
        ?>
    </div>
</div>
        
        <div class="product">
    
        </div>
    </section>

    <script>
        function searchProducts() {
            alert("Search!");
        }

        function showCategory(category) {
            alert("Displaying products in the " + category + " category!");
        }

    </script>

</body>
</html>

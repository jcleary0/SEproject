<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit a review to help customers like you!</title>
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
            display: flex;
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
            justify-content: center;
            margin-bottom: 10px;
        }

        .column {
            width: 150px;
            height: 150px;
            margin: 0 10px;
            border-radius: 5px;
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

        .btn {
            padding: 10px 20px;
            background-image: linear-gradient(to bottom right, #d8d6d6, #b5b5b5);
            color: #000000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-image 0.3s ease;
            text-decoration: none;
        }

        .btn:hover {
            background-image: linear-gradient(to bottom right, #7a8d93, #a8bdbc);
        }

        .submit-review {
            display: flex;
            justify-content: center;
            margin-top: 50px;
            margin-bottom: 20px;
        }

        .comment-input {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
	    text-align: center;
        }

        .comment-input input[type="text"],
        .comment-input textarea {
            margin-bottom: 10px;
            padding: 10px;
            width: 70%;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
	    text-align: center;
        }

        .comment-input textarea {
            height: 100px;
        }
    </style>
</head>

<body>

    <header>
    
        <img src="logo.png" alt="Logo" class="logo">
        <div>
            <h1 class="header-text">Leave a Review</h1>
            <h2 class="subheading">Help other customers find what they're looking for</h2>
        </div>
    </header>

    <div class="panel">
        <div class="panel-heading">Pick a product from the listed options below to leave a comment and rating</div>
        <div class="comment-input">
            <form method="post" action="submitComment.php">
        <label for="product">Select Product:</label>
        <select id="product" name="product" required>
            <?php
            include('include/project_config.php');

            // Fetch products from database
            $query = "SELECT name FROM products";
            $result = $sql->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $productName = $row['name'];
                    echo "<option value='$productName'>$productName</option>";
                }
            } else {
                echo "<option value='' disabled>No products available</option>";
            }
            ?>
        </select><br>
        <label for="rating">Select Rating:</label>
        <select id="rating" name="rating" required>
            <option value="1">Horrible</option>
            <option value="2">Bad</option>
            <option value="3">Okay</option>
            <option value="4">Good</option>
            <option value="5">Great</option>
        </select><br>
        <label for="comment">Your Comment:</label><br>
        <textarea id="comment" name="comment" rows="4" cols="50" required></textarea><br>
        <button type="submit">Submit</button>
    </form>

        </div>
    </div>

   
   <section>

       
    </div>
        

        <div class="popular-products">
            <h2></h2>
            
        
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

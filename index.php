<?php
require 'product_config.php';
if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
}
else{
    header("Location: userLogin.php");
}
?>

<!DOCTYPE html>
<html lang= "en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Index</title>
</head>
<body>
    <h1>Welcome </h1>
    <a href="logout.php">Logout</a>
</body>
</html>

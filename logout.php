<?php
require 'product_config.php';
$_SESSION = [];
session_unset();
session_destroy();
header("Location: userLogin.php");
?>
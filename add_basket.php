<?php
require 'db_connect.php'; // Include database connection

session_start()

if (isset($_POST['item'])) {
    $_SESSION['cart'] = $_POST['item'];
    header("Location: ".$_SERVER['REQUEST_URI']);
    exit;
}
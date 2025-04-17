<?php
include_once('../db_connection.php'); // ধরে নিচ্ছি $pdo আছে এখানে

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['product_name'];
    $amount = $_POST['product_amount'];
    $date = $_POST['product_date'];

    $stmt = $conn->prepare("INSERT INTO products (product_name, product_amount, product_date) VALUES (?, ?, ?)");
    $stmt->execute([$name, $amount, $date]);

    header("Location: product.php?message=product_added");
    exit;
}
?>
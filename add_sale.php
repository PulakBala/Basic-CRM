<?php
include_once('../db_connection.php'); // ধরে নিচ্ছি $pdo আছে এখানে

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['sale_name'];
    $amount = $_POST['sale_amount'];
    $date = $_POST['sale_date'];

    $stmt = $conn->prepare("INSERT INTO sales (sale_name, sale_amount, sale_date) VALUES (?, ?, ?)");
    $stmt->execute([$name, $amount, $date]);

    header("Location: index.php?message=sale_added");
    exit;

    
}
?>


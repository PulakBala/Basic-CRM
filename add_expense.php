<?php
include_once('../db_connection.php'); // ধরে নিচ্ছি $pdo আছে এখানে

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['expense_name'];
    $amount = $_POST['expense_amount'];
    $date = $_POST['expense_date'];

    $stmt = $conn->prepare("INSERT INTO expenses (expense_name, expense_amount, expense_date) VALUES (?, ?, ?)");
    $stmt->execute([$name, $amount, $date]);

    header("Location: index.php?message=expense_added");
    exit;

    
}
?>

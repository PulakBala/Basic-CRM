<?php
include('../db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $service = $_POST['service'];
    $account = $_POST['account'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    try {
        $stmt = $conn->prepare("INSERT INTO dues (name, amount, service, account, mobile, address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $amount, $service, $account, $mobile, $address]);

        header("Location: due.php?message=save_due");
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error saving due: " . $e->getMessage();
        header("Location: add_due.php");
        exit;
    }
} else {
    header("Location: add_due.php");
    exit;
}
?>

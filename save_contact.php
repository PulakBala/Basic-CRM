<?php
include_once('../db_connection.php'); // Change path if needed

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate input
    $name     = trim($_POST['name'] ?? '');
    $mobile   = trim($_POST['mobile'] ?? '');
    $address  = trim($_POST['address'] ?? '');
    $service  = trim($_POST['service'] ?? '');
    $facebook = trim($_POST['facebook'] ?? '');

    // Basic validation
    if ($name && $mobile && $address && $service) {
        try {
            $stmt = $conn->prepare("INSERT INTO contacts (name, mobile, address, service, facebook) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $mobile, $address, $service, $facebook]);

            header("Location: contact.php?message=success");
            exit;
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    } else {
        echo "Please fill in all required fields.";
    }
} else {
    header("Location: contact.php");
    exit;
}
?>

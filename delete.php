<?php
include('../db_connection.php');

// Required GET parameters
$table = $_GET['table'] ?? null;
$id = $_GET['id'] ?? null;
$redirect = $_GET['redirect'] ?? 'index.php'; // fallback

// Allowed tables for safety
$allowedTables = ['sales', 'expenses', 'products', 'contacts', 'dues', 'prices', 'users'];

if ($table && $id && in_array($table, $allowedTables)) {
    $query = "DELETE FROM $table WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt->execute([$id])) {
        header("Location: $redirect?message={$table}_deleted");
        exit;
    } else {
        header("Location: $redirect?message=delete_failed");
        exit;
    }
} else {
    header("Location: $redirect?message=invalid_request");
    exit;
}

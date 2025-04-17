<?php
include('../db_connection.php');
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<!-- Top Navbar -->
<nav class="navbar navbar-dark bg-dark sticky-top">
    <button class="btn btn-outline-light d-md-none" type="button" data-toggle="collapse" data-target="#sidebarMenu">
        <i class="fas fa-bars"></i>
    </button>
    <span class="navbar-brand mb-0 h1">Admin Panel</span>
</nav>

<?php
include('../db_connection.php');

// Initialize totals
$saleTotal = 0;
$expenseTotal = 0;
$monthlySales = [];
$monthlyExpenses = [];

// Fetch Monthly Sales
$saleQuery = $conn->query("SELECT YEAR(sale_date) AS year, MONTH(sale_date) AS month, SUM(sale_amount) AS total 
                           FROM sales GROUP BY year, month ORDER BY year DESC, month DESC");
$saleResults = $saleQuery->fetchAll(PDO::FETCH_ASSOC);
foreach ($saleResults as $row) {
    $key = $row['year'] . '-' . str_pad($row['month'], 2, '0', STR_PAD_LEFT);
    $monthlySales[$key] = $row['total'];
    $saleTotal += $row['total'];
}

// Fetch Monthly Expenses
$expenseQuery = $conn->query("SELECT YEAR(expense_date) AS year, MONTH(expense_date) AS month, SUM(expense_amount) AS total 
                              FROM expenses GROUP BY year, month ORDER BY year DESC, month DESC");
$expenseResults = $expenseQuery->fetchAll(PDO::FETCH_ASSOC);
foreach ($expenseResults as $row) {
    $key = $row['year'] . '-' . str_pad($row['month'], 2, '0', STR_PAD_LEFT);
    $monthlyExpenses[$key] = $row['total'];
    $expenseTotal += $row['total'];
}
?>

<?php
$pdo = $conn; // Important! Map the $conn from db_connection.php to $pdo

function getTotalRevenue($month, $year) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT SUM(sale_amount) FROM sales WHERE MONTH(sale_date) = :month AND YEAR(sale_date) = :year");
    $stmt->execute(['month' => $month, 'year' => $year]);
    return $stmt->fetchColumn() ?: 0;
}  

function getTotalExpense($month, $year) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT SUM(expense_amount) FROM expenses WHERE MONTH(expense_date) = :month AND YEAR(expense_date) = :year");
    $stmt->execute(['month' => $month, 'year' => $year]);
    return $stmt->fetchColumn() ?: 0;
}
?>

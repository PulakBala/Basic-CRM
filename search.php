<?php
include('../db_connection.php');

$table = $_GET['table'] ?? '';
$keyword = $_GET['keyword'] ?? '';

// Table -> Searchable column map
$allowedTables = [
    'sales' => 'sale_name',
    'expenses' => 'expense_name',
    'products' => 'product_name',
    'contacts' => 'name',
    'dues' => 'name',
];

// Table -> Column map for amount and date
$columnMap = [
    'sales' => ['amount' => 'sale_amount', 'date' => 'sale_date'],
    'expenses' => ['amount' => 'expense_amount', 'date' => 'expense_date'], // if same style
    'products' => ['amount' => 'product_amount', 'date' => 'product_date'], // adjust as needed
  
];
if (!array_key_exists($table, $allowedTables)) {
    echo "Invalid table.";
    exit;
}

$column = $allowedTables[$table];

$stmt = $conn->prepare("SELECT * FROM $table WHERE $column LIKE ?");
$stmt->execute(["%$keyword%"]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $index => $row) {
    echo "<tr>";
    echo "<td>" . ($index + 1) . "</td>";
    echo "<td>" . htmlspecialchars($row[$column]) . "</td>";

    // Conditional Display
    if ($table === 'contacts') {
        echo "<td>" . htmlspecialchars($row['mobile']) . "</td>";
        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
        echo "<td>" . htmlspecialchars($row['service']) . "</td>";
        echo "<td>
                <a href='" . htmlspecialchars($row['facebook']) . "' target='_blank' class='btn btn-sm btn-outline-primary'>View</a>
             </td>";
    } elseif($table === 'dues'){
        
        echo "<td>" . number_format($row['amount'], 2) . "</td>";
        echo "<td>" . htmlspecialchars($row['service']) . "</td>";
        echo "<td>" . htmlspecialchars($row['account']) . "</td>";
        echo "<td>" . htmlspecialchars($row['mobile']) . "</td>";
        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
    }
    else {
        $amountKey = $columnMap[$table]['amount'] ?? null;
        $dateKey = $columnMap[$table]['date'] ?? null;

        echo "<td>" . number_format($row[$amountKey] ?? 0, 2) . "</td>";
        echo "<td>" . ($row[$dateKey] ?? '-') . "</td>";
    }

    echo "<td>
        <a href='edit.php?table=$table&id=" . $row['id'] . "&redirect=$table.php' class='btn btn-sm btn-warning'>Edit</a>
        <a href='delete.php?table=$table&id=" . $row['id'] . "&redirect=$table.php' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure?');\">Delete</a>
    </td>";
    echo "</tr>";
}
?>

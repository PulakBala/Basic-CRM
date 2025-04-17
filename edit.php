<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include('../db_connection.php');

$table = $_GET['table'] ?? '';
$id = $_GET['id'] ?? '';
$redirect = $_GET['redirect'] ?? 'index.php';

// Allowed tables and their fields
$config = [
    'sales' => ['sale_name', 'sale_amount', 'sale_date'],
    'expenses' => ['expense_name', 'expense_amount', 'expense_date'],
    'products' => ['product_name', 'product_amount', 'product_date']
];

if (!isset($config[$table]) || empty($id)) {
    header("Location: $redirect?message=invalid_request");
    exit;
}

// Fetch data
$stmt = $conn->prepare("SELECT * FROM $table WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    header("Location: $redirect?message=not_found");
    exit;
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = $config[$table];
    $values = [];

    foreach ($fields as $field) {
        $values[$field] = $_POST[$field] ?? '';
    }

    // Build SET part dynamically
    $setPart = implode(', ', array_map(fn($f) => "$f = ?", $fields));
    $updateStmt = $conn->prepare("UPDATE $table SET $setPart WHERE id = ?");
    $success = $updateStmt->execute([...array_values($values), $id]);

    if ($success) {
        header("Location: $redirect?message=update_success");
    } else {
        header("Location: $redirect?message=update_failed");
    }
    exit;
}
?>

<!-- HTML Form Part -->
<?php include('includes/header.php'); include('includes/sidebar.php'); ?>
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5>Edit <?php echo ucfirst($table); ?></h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <?php
                foreach ($config[$table] as $field) {
                    $label = ucwords(str_replace('_', ' ', $field));
                    $type = strpos($field, 'date') !== false ? 'date' : (strpos($field, 'amount') !== false ? 'number' : 'text');
                    echo "
                        <div class='mb-3'>
                            <label class='form-label'>$label</label>
                            <input type='$type' name='$field' class='form-control' value='" . htmlspecialchars($data[$field]) . "' required>
                        </div>
                    ";
                }
                ?>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="<?php echo htmlspecialchars($redirect); ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>

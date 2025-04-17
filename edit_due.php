<?php
include('includes/header.php');
include('includes/sidebar.php');

// Check if ID and table are provided
if (!isset($_GET['id']) || !isset($_GET['table'])) {
    echo "<div class='container mt-5 alert alert-danger'>Invalid request.</div>";
    include('includes/footer.php');
    exit;
}

$id = $_GET['id'];
$table = $_GET['table'];
$redirect = $_GET['redirect'] ?? 'due_list.php';

// Fetch existing data
$stmt = $conn->prepare("SELECT * FROM $table WHERE id = ?");
$stmt->execute([$id]);
$due = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$due) {
    echo "<div class='container mt-5 alert alert-danger'>Record not found!</div>";
    include('includes/footer.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $service = $_POST['service'];
    $account = $_POST['account'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    try {
        $update = $conn->prepare("UPDATE $table SET name = ?, amount = ?, service = ?, account = ?, mobile = ?, address = ? WHERE id = ?");
        $update->execute([$name, $amount, $service, $account, $mobile, $address, $id]);

        echo "<script>window.location.href='$redirect';</script>";
        exit;
    } catch (PDOException $e) {
        echo "<div class='container mt-5 alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>

<div class="container mt-2">
    <div class="col-md-8 mx-auto">
        <div class="card shadow">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0">Edit Due</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($due['name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" class="form-control" value="<?= htmlspecialchars($due['amount']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="service">Service</label>
                        <input type="text" name="service" class="form-control" value="<?= htmlspecialchars($due['service']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="account">Account</label>
                        <input type="text" name="account" class="form-control" value="<?= htmlspecialchars($due['account']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile">Mobile</label>
                        <input type="text" name="mobile" class="form-control" value="<?= htmlspecialchars($due['mobile']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="address">Address</label>
                        <textarea name="address" class="form-control" rows="2" required><?= htmlspecialchars($due['address']) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<?php
ob_start();
include('includes/header.php');
include('includes/sidebar.php');

// Handle Insert or Update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $package_type = $_POST['package_type'];
    $amount = $_POST['amount'];

    // Fix for trimming whitespace
    $featuresArray = array_map('trim', explode(',', $_POST['features']));
    $features = json_encode($featuresArray);

    if (!empty($_POST['id'])) {
        $stmt = $conn->prepare("UPDATE prices SET package_type=?, amount=?, features=?, updated_at=NOW() WHERE id=?");
        $stmt->execute([$package_type, $amount, $features, $_POST['id']]);
    } else {
        $stmt = $conn->prepare("INSERT INTO prices (package_type, amount, features, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
        $stmt->execute([$package_type, $amount, $features]);
    }

    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}



// Fetch all prices
$stmt = $conn->query("SELECT  id, package_type, amount, features FROM prices ORDER BY id ASC");
$prices = $stmt->fetchAll(PDO::FETCH_ASSOC);

// For editing
$editData = null;
if (isset($_GET['edit'])) {
    $stmt = $conn->prepare("SELECT id, package_type, amount, features FROM prices WHERE id=?");
    $stmt->execute([$_GET['edit']]);
    $editData = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($editData) {
        $editData['features'] = implode(', ', json_decode($editData['features']));
    }
}
?>

<div class=" py-4">

        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <?= $editData ? "Edit Package" : "Add New Package" ?>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

                        <div class="mb-3">
                            <label class="form-label">Package Type</label>
                            <input type="text" name="package_type" class="form-control" value="<?= $editData['package_type'] ?? '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" value="<?= $editData['amount'] ?? '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Features (comma separated)</label>
                            <input type="text" name="features" placeholder=" abc, bcd, cdd" class="form-control" value="<?= $editData['features'] ?? '' ?>" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            <?= $editData ? "Update Package" : "Add Package" ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    Package List
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Features</th>
                               
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($prices as $row): ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['package_type']) ?></td>
                                    <td>৳<?= number_format($row['amount'], 2) ?></td>
                                    <td>
                                        <ul class="mb-0 ps-3">
                                            <?php foreach (json_decode($row['features']) as $feature): ?>
                                                <li><?= htmlspecialchars(trim($feature)) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>
                                  
                                    <td>
                                        <a href="?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm mb-1">Edit</a>
                                        <a href='delete.php?table=prices&id=<?= $row['id'] ?>&redirect=price.php' class='btn btn-sm btn-danger' onclick="return confirm('Are you sure?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (count($prices) === 0): ?>
                                <tr><td colspan="7" class="text-center">No package found</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
 
</div>

<?php include('includes/footer.php'); ?>

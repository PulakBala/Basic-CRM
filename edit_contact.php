<?php
ob_start();
include ('includes/header.php');
include ('includes/sidebar.php');

$table = $_GET['table'] ?? 'contacts';
$id = $_GET['id'] ?? null;
$redirect = $_GET['redirect'] ?? 'contact_list.php';

if (!$id || $table !== 'contacts') {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Invalid request!</div></div>";
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $service = $_POST['service'];
    $facebook = $_POST['facebook'];

    $stmt = $conn->prepare("UPDATE contacts SET name = ?, mobile = ?, address = ?, service = ?, facebook = ? WHERE id = ?");
    $stmt->execute([$name, $mobile, $address, $service, $facebook, $id]);

    header("Location: $redirect?message=updated");
    exit;
}

// Fetch contact
$stmt = $conn->prepare("SELECT id, name , mobile, address, service, facebook FROM contacts WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$contact) {
    echo "<div class='container mt-5'><div class='alert alert-warning'>Contact not found.</div></div>";
    exit;
}
?>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Edit Contact</h5>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($contact['name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mobile Number</label>
                    <input type="text" name="mobile" class="form-control" value="<?= htmlspecialchars($contact['mobile']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2" required><?= htmlspecialchars($contact['address']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Service</label>
                    <input type="text" name="service" class="form-control" value="<?= htmlspecialchars($contact['service']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Facebook Link</label>
                    <input type="url" name="facebook" class="form-control" value="<?= htmlspecialchars($contact['facebook']) ?>">
                </div>
                <button type="submit" class="btn btn-warning w-100">Update Contact</button>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

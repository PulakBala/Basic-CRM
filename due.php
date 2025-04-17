<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Add Due Information</h5>
                </div>
                <div class="card-body">
                    <form action="save_due.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter full name" required>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter amount" required>
                        </div>

                        <div class="mb-3">
                            <label for="service" class="form-label">Service</label>
                            <input type="text" name="service" id="service" class="form-control" placeholder="Enter service name" required>
                        </div>

                        <div class="mb-3">
                            <label for="account" class="form-label">Account Number</label>
                            <input type="text" name="account" id="account" class="form-control" placeholder="Enter account details" required>
                        </div>

                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile Number</label>
                            <input type="tel" name="mobile" id="mobile" class="form-control" placeholder="Enter mobile number" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control" rows="2" placeholder="Enter address" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-danger w-100">Submit Due Info</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'alert-handler.php'; ?>
<?php include('includes/footer.php'); ?>
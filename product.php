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
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Add New Product</h5>
                </div>
                <div class="card-body">
                    <form action="add_product.php" method="POST">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter product name" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_amount" class="form-label">Amount</label>
                            <input type="number" name="product_amount" id="product_amount" class="form-control" placeholder="Enter amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_date" class="form-label">Date</label>
                            <input type="date" name="product_date" id="product_date" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'alert-handler.php'; ?>
<?php include('includes/footer.php'); ?>

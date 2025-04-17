<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
include ('includes/header.php');
include ('includes/sidebar.php');
include('calculation_dashboard.php')
?>

<div class="">
<div class="row">
      <!-- sale Card -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm" style="background-image: url('../images/sale1.jpg'); background-size: contain; background-repeat: no-repeat; background-position: center;">
                <div class="" style="background-color: rgba(139, 243, 163, 0.9);">
                     <div class="card-header text-white">
                        <h5 class="mb-0 text-center">Sale</h5>
                    </div>
                    <div class="card-body text-center text-black">
                    <p>৳ <?= number_format($monthlySales[date('Y-m')] ?? 0) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- expense Card -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm" style="background-image: url('../images/expense.png'); background-size: contain; background-repeat: no-repeat; background-position: center; ">
                <div class="" style="background-color: rgba(241, 37, 47, 0.9);">
                     <div class="card-header text-white">
                        <h5 class="mb-0 text-center">Expense</h5>
                    </div>
                    <div class="card-body text-center text-black">
                    <p>৳ <?= number_format($monthlyExpenses[date('Y-m')] ?? 0) ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- total sale  -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm" style="background-image: url('../images/totalsale.png');background-size: contain; background-repeat: no-repeat; background-position: center;">
                <div class="" style="background-color: rgba(16, 112, 202, 0.9);">
                     <div class="card-header text-white">
                        <h5 class="mb-0 text-center">Total Sale</h5>
                    </div>
                    <div class="card-body text-center text-black">
                    <p>৳ <?= number_format($saleTotal) ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- total expense -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm" style="background-image: url('../images/totalex.webp');background-size: contain; background-repeat: no-repeat; background-position: center;">
                <div class="" style="background-color: rgba(194, 216, 216, 0.9);">
                     <div class="card-header text-white">
                        <h5 class="mb-0 text-center">Total Expense</h5>
                    </div>
                    <div class="card-body text-center text-black">
                    <p>৳ <?= number_format($expenseTotal) ?></p>
                    </div>
                </div>
            </div>
        </div>
    
</div>

<div class="row mt-4">

<!-- Sale Card -->
<div class="col-md-6 mb-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Add Sale</h5>
        </div>
        <div class="card-body">
            <form action="add_sale.php" method="POST">
                <div class="mb-3">
                    <label for="sale_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="sale_name" name="sale_name" placeholder="Enter sale name" required>
                </div>
                <div class="mb-3">
                    <label for="sale_amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" id="sale_amount" name="sale_amount" placeholder="Enter amount" required>
                </div>
                <div class="mb-3">
                    <label for="sale_date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="sale_date" name="sale_date" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Submit Sale</button>
            </form>
        </div>
    </div>
</div>

<!-- Expense Card -->
<div class="col-md-6 mb-4">
    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Add Expense</h5>
        </div>
        <div class="card-body">
            <form action="add_expense.php" method="POST">
                <div class="mb-3">
                    <label for="expense_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="expense_name" name="expense_name" placeholder="Enter expense name" required>
                </div>
                <div class="mb-3">
                    <label for="expense_amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" id="expense_amount" name="expense_amount" placeholder="Enter amount" required>
                </div>
                <div class="mb-3">
                    <label for="expense_date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="expense_date" name="expense_date" required>
                </div>
                <button type="submit" class="btn btn-danger w-100">Submit Expense</button>
            </form>
        </div>
    </div>
</div>

</div>

</div>

<?php include 'alert-handler.php'; ?>

<?php include ('includes/footer.php'); ?>

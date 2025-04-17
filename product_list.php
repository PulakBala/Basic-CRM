<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
include ('includes/header.php');
include ('includes/sidebar.php');
?>
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">All Products</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <input type="text" id="search-input" data-table="products" class="form-control mb-3" placeholder="Search by name...">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <!-- Example row, replace with PHP loop -->
                        <?php

                        $stmt = $conn->query('SELECT id, product_name, product_amount, product_date FROM products ORDER BY product_date DESC');
                        $count = 1;
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . $count++ . '</td>';
                            echo '<td>' . htmlspecialchars($row['product_name']) . '</td>';
                            echo '<td>' . number_format($row['product_amount'], 2) . '</td>';
                            echo '<td>' . $row['product_date'] . '</td>';
                            echo "<td>
                                    <a href='edit.php?table=products&id=" . $row['id'] . "&redirect=product_list.php' class='btn btn-sm btn-warning'>Edit</a>
                                    <a href='delete.php?table=products&id=" . $row['id'] . "&redirect=product_list.php' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure?');\">Delete</a>

                                 </td>";
                            echo '</tr>';
                        }
                        ?>
                        <!-- End example -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/script.js"></script>
<?php include ('includes/footer.php'); ?>

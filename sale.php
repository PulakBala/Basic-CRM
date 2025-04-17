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
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Sale Records</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <input type="text" id="search-input" data-table="sales" class="form-control mb-3" placeholder="Search by name...">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-success">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <!-- Sample Row (replace with PHP loop) -->
                        <?php
                     

                        $stmt = $conn->query('SELECT id, sale_name, sale_amount, sale_date FROM sales ORDER BY sale_date DESC');
                        $count = 1;
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . $count++ . '</td>';
                            echo '<td>' . htmlspecialchars($row['sale_name']) . '</td>';
                            echo '<td>' . number_format($row['sale_amount'], 2) . '</td>';
                            echo '<td>' . $row['sale_date'] . '</td>';
                            echo "<td>
                                    <a href='edit.php?table=sales&id=" . $row['id'] . "&redirect=sale.php' class='btn btn-sm btn-warning'>Edit</a>
                                    <a href='delete.php?table=sales&id=" . $row['id'] . "&redirect=sale.php' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure?');\">Delete</a>

                                 </td>";
                            echo '</tr>';
                        }
                        ?>
                        <!-- Repeat rows dynamically using PHP -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/script.js"></script>
<?php include ('includes/footer.php'); ?>
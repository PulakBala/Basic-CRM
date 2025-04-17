<?php
include ('includes/header.php');
include ('includes/sidebar.php');
include('pagination.php');
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
                        try {
                            $pagination = paginate($conn, 'products', 'id, product_name, product_amount, product_date', '', 'product_date DESC', 10);  
                            $count = ($pagination['current_page'] - 1) * 10 + 1;

                            foreach ($pagination['data'] as $row) {
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
                        } catch (PDOException $e) {
                            echo '<tr><td colspan="8" class="text-danger">Error: ' . $e->getMessage() . '</td></tr>';
                        }
                        ?>
                        <!-- End example -->
                    </tbody>
                </table>
                <?php
                renderPagination($pagination['total_pages'], $pagination['current_page'], 'product_list.php');
                ?>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/script.js"></script>
<?php include ('includes/footer.php'); ?>

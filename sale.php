<?php
include ('includes/header.php');
include ('includes/sidebar.php');
include ('pagination.php');
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
                     

                     try {
                        $pagination = paginate($conn, 'sales', 'id, sale_name, sale_amount,  sale_date', '', 'sale_date DESC', 10);
                        $count = ($pagination['current_page'] - 1) * 10 + 1;

                        foreach ($pagination['data'] as $row) {
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
                    } catch (PDOException $e) {
                        echo '<tr><td colspan="8" class="text-danger">Error: ' . $e->getMessage() . '</td></tr>';
                    }
                        ?>
                        <!-- Repeat rows dynamically using PHP -->
                    </tbody>
                </table>
                <?php
                renderPagination($pagination['total_pages'], $pagination['current_page'], 'sale.php');
                ?>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/script.js"></script>
<?php include ('includes/footer.php'); ?>
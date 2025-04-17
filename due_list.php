<?php
include ('includes/header.php');
include ('includes/sidebar.php');
include('pagination.php');
?>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Due List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <input type="text" id="search-input" data-table="dues" class="form-control mb-3" placeholder="Search by name...">
            <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Service</th>
                    <th>Account</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="table-body">
            <?php
                try {
                    $pagination = paginate($conn, 'dues', 'id, name, amount, service, account, mobile, address', '', 'created_at DESC', 10);
                    $count = ($pagination['current_page'] - 1) * 10 + 1;

                    foreach ($pagination['data'] as $row) {
                        echo '<tr>';
                        echo '<td>' . $count++ . '</td>';
                        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['amount']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['service']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['account']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['mobile']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['address']) . '</td>';
                        echo "<td>
                                <a href='edit_due.php?table=dues&id=" . $row['id'] . "&redirect=due_list.php' class='btn btn-sm btn-warning'>Edit</a>
                                <a href='delete.php?table=dues&id=" . $row['id'] . "&redirect=due_list.php' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure?');\">Delete</a>
                            </td>";
                        echo '</tr>';
                    }
                } catch (PDOException $e) {
                    echo '<tr><td colspan="8" class="text-danger">Error: ' . $e->getMessage() . '</td></tr>';
                }
                ?>
                            </tbody>
                            
                        </table>
                        <?php
                renderPagination($pagination['total_pages'], $pagination['current_page'], 'due_list.php');
                ?>
            </div>
        </div>
    </div>
</div>


<script src="assets/js/script.js"></script>
<?php include ('includes/footer.php'); ?>
<?php
function paginate($conn, $table, $columns = '*', $where = '', $orderBy = 'id DESC', $limit = 10) {
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $offset = ($page - 1) * $limit;

    // Count total rows
    $countQuery = "SELECT COUNT(*) as total FROM $table " . ($where ? "WHERE $where" : '');
    $stmt = $conn->query($countQuery);
    $totalRows = $stmt->fetch()['total'];
    $totalPages = ceil($totalRows / $limit);

    // Fetch paginated data
    $query = "SELECT $columns FROM $table " . ($where ? "WHERE $where" : '') . " ORDER BY $orderBy LIMIT $limit OFFSET $offset";
    $data = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);

    return [
        'data' => $data,
        'total_pages' => $totalPages,
        'current_page' => $page
    ];
}

function renderPagination($totalPages, $currentPage, $baseUrl) {
    if ($totalPages <= 1) return;

    echo '<nav><ul class="pagination justify-content-center">';

    for ($i = 1; $i <= $totalPages; $i++) {
        $active = ($i == $currentPage) ? 'active' : '';
        echo "<li class='page-item $active'><a class='page-link' href='{$baseUrl}?page=$i'>$i</a></li>";
    }

    echo '</ul></nav>';
}

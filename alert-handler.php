<?php if (isset($_GET['message'])): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if ($_GET['message'] == 'sale_added'): ?>
            Swal.fire({
                title: 'Success!',
                text: 'Sale added successfully!',
                icon: 'success',
                showConfirmButton: false,
                timer: 2000
            });
        <?php elseif ($_GET['message'] == 'expense_added'): ?>
            Swal.fire({
                title: 'Success!',
                text: 'Expense added successfully!',
                icon: 'success',
                showConfirmButton: false,
                timer: 2000
            });
        <?php elseif ($_GET['message'] == 'product_added'): ?>
            Swal.fire({
                title: 'Success!',
                text: 'Product added successfully!',
                icon: 'success',
                showConfirmButton: false,
                timer: 2000
            });
        <?php elseif ($_GET['message'] == 'success'): ?>
            Swal.fire({
                title: 'Success!',
                text: 'Contact added successfully!',
                icon: 'success',
                showConfirmButton: false,
                timer: 2000
            });
        <?php elseif ($_GET['message'] == 'save_due'): ?>
            Swal.fire({
                title: 'Success!',
                text: 'Due added successfully!',
                icon: 'success',
                showConfirmButton: false,
                timer: 2000
            });
        <?php elseif ($_GET['message'] == 'error'): ?>
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong!',
                icon: 'error',
                showConfirmButton: true
            });
        <?php endif; ?>

        // Clean URL after alert (optional but good)
        if (window.history.replaceState) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    </script>
<?php endif; ?>

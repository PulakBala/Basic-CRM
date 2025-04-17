<?php
include('includes/header.php');
include('includes/sidebar.php');
?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Contact Information</h5>
                </div>
                <div class="card-body">
                    <form action="save_contact.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter full name" required>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile Number</label>
                            <input type="tel" name="mobile" id="mobile" class="form-control" placeholder="Enter mobile number" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control" rows="2" placeholder="Enter address" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="service" class="form-label">Service</label>
                            <input type="text" name="service" id="service" class="form-control" placeholder="Enter service name" required>
                        </div>
                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook Link</label>
                            <input type="url" name="facebook" id="facebook" class="form-control" placeholder="https://facebook.com/yourprofile">
                        </div>
                        <button type="submit" class="btn btn-info w-100">Submit Contact Info</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'alert-handler.php'; ?>
<?php include('includes/footer.php'); ?>